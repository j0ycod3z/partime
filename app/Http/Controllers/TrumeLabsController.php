<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TrumeLabsService;
use Illuminate\Support\Facades\Log;

class TrumeLabsController extends Controller
{
    protected $trumeLabs;

    public function __construct(TrumeLabsService $trumeLabs)
    {
        $this->trumeLabs = $trumeLabs;
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'first_name'         => 'required|string',
            'last_name'          => 'required|string',
            'email'              => 'required|email',
            'date_of_birth'      => 'required|date',
            'biological_sex'     => 'nullable|string',
            'gender'             => 'nullable|string',
            'country'            => 'nullable|string',
            'ethnicity'          => 'nullable|string',
            'allow_trume_login'  => 'nullable|boolean',
        ]);

        // Convert checkbox to boolean if not passed
        $validated['allow_trume_login'] = $request->has('allow_trume_login');

        $response = $this->trumeLabs->createUser($validated);

        // Redirect or show response
        return redirect()->back()->with('success', 'User created successfully.');
    }
    public function updateUser(Request $request, $id)
    {
        if (!$id) {
            abort(400, 'Missing user ID.');
        }
    
        Log::debug('Updating user ID:', ['id' => $id]);

        $validated = $request->validate([
            'first_name'         => 'required|string',
            'last_name'          => 'required|string',
            'email'              => 'required|email',
            'date_of_birth'      => 'required|date',
            'biological_sex'     => 'nullable|string',
            'gender'             => 'nullable|string',
            'country'            => 'nullable|string',
            'ethnicity'          => 'nullable|string',
            'allow_trume_login'  => 'nullable|boolean',
        ]);
    
        // Convert checkbox to boolean
        $validated['allow_trume_login'] = $request->has('allow_trume_login');
    
        $this->trumeLabs->updateUser($id, $validated);
    
        return redirect()->back()->with('success', 'User updated successfully.');
    }
    
    public function getUser(Request $request)
    {
        $id = trim($request->query('id'));
        $email = trim($request->query('email'));

        if (!$id && !$email) {
            return response()->json(['error' => 'You must provide either an ID or email.'], 422);
        }

        // Optional: input validation
        if ($id && !is_numeric($id)) {
            return response()->json(['error' => 'Invalid ID format.'], 422);
        }

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Invalid email format.'], 422);
        }

        try {
            $user = $this->trumeLabs->getUser(compact('id', 'email'));

            if (!$user || isset($user['error'])) {
                return response()->json(['error' => $user['error'] ?? 'User not found.'], 404);
            }

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getUnregisteredKits()
    {
        return response()->json($this->trumeLabs->getUnregisteredKits());
    }
    
    public function getUserFromApi($query)
    {
        return $this->trumeLabs->getUser($query); // This calls the TrumeLabsService logic
    }
    public function registerKit($barcode, Request $request)
    {
        return response()->json($this->trumeLabs->registerKit($barcode, $request->all()));
    }

    public function updateKit($barcode, Request $request)
    {
        return response()->json($this->trumeLabs->updateKit($barcode, $request->all()));
    }

    public function mockKitResult(Request $request)
{
    try {
        $q = trim($request->get('q'));

        if (!$q) {
            \Log::warning('Kit search attempted with empty query.');
            return response()->json([
                'status' => 'error',
                'message' => 'Missing query',
                'data' => []
            ], 422);
        }

        // Determine search type
        $query = [];

        if (filter_var($q, FILTER_VALIDATE_EMAIL)) {
            $query['email'] = $q;
        } else {
            $query['id'] = $q;
        }
        \Log::debug('Request query all:', $request->query());

        \Log::info('Kit search query parsed:', $query);

        // Call the service method
        $results = $this->trumeLabs->mockKitResult($query);

        \Log::info('Kit search results:', $results); // works for arrays too


        return response()->json([
            'status' => 'success',
            'data' => $results
        ], 200);

    } catch (\Throwable $e) {
        \Log::error('Kit search error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred.',
            'exception' => $e->getMessage(),
            'data' => []
        ], 500);
    }
}




    public function generateKit(Request $request)
    {
        return response()->json($this->trumeLabs->generateKit($request->all()));
    }

    // public function mockKitResult(Request $request)
    // {
    //     return response()->json($this->trumeLabs->mockKitResult($request->all()));
    // }

    public function kitsIndex()
    {
        $registeredKits = [
            [
                'barcode' => 'KIT123456',
                'user' => 'Juan Dela Cruz',
            ],
            [
                'barcode' => 'KIT789101',
                'user' => 'Maria Santos',
            ],
            // ... ideally fetched from TrumeLabs if supported
        ];

    // Call API to get unregistered kits and results
    $unregisteredKits = $this->trumeLabs->getUnregisteredKits();
    $results = $this->trumeLabs->getResults([]);

        return view('dashboard.kits', compact('registeredKits', 'unregisteredKits', 'results'));
    }
}


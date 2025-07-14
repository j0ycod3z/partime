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
        $id = $request->query('id');
        $email = $request->query('email');

        if (!$id && !$email) {
            return response()->json(['error' => 'You must provide either id or email.'], 422);
        }

        $user = $this->trumeLabs->getUser(compact('id', 'email'));

        return response()->json($user);
    }
        

    public function getUnregisteredKits()
    {
        return response()->json($this->trumeLabs->getUnregisteredKits());
    }
    

    public function registerKit($barcode, Request $request)
    {
        return response()->json($this->trumeLabs->registerKit($barcode, $request->all()));
    }

    public function updateKit($barcode, Request $request)
    {
        return response()->json($this->trumeLabs->updateKit($barcode, $request->all()));
    }

    public function getResults(Request $request)
    {
        return response()->json($this->trumeLabs->getResults($request->all()));
    }

    public function generateKit(Request $request)
    {
        return response()->json($this->trumeLabs->generateKit($request->all()));
    }

    public function mockKitResult(Request $request)
    {
        return response()->json($this->trumeLabs->mockKitResult($request->all()));
    }

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


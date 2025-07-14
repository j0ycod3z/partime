<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrumeLabsController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes return frontend views or static test data for display.
*/

// Route::get('/', fn() => view('auth.login'))->name('login');

$kits = [
    [
        'id' => 'user123',
        'email' => 'john@example.com',
        'bio_age_results' => [
            [
                'kit_barcode' => 'KIT12345',
                'chronological_age' => 30,
                'biological_age' => 28,
                'peer_biological_age_score' => 92,
                'collection_date' => now(),
                'share_link' => 'https://example.com/results/123'
            ]
        ],
        'genetic_results' => [
            [
                'kit_barcode' => 'KIT12345',
                'markers' => [
                    ['marker' => 'rs123', 'risk' => 'High', 'gene' => 'BRCA1', 'position' => '17q21.31'],
                ]
            ]
        ]
    ],
    [
        'id' => 'user456',
        'email' => 'jane@example.com',
        'bio_age_results' => [],
        'genetic_results' => []
    ]
];

// Search route
Route::get('/kit-search', function (Illuminate\Http\Request $request) use ($kits) {
    $query = $request->get('q');
    $result = collect($kits)->first(fn($kit) => $kit['id'] === $query || $kit['email'] === $query);

    return view('dashboard.kit-search', ['results' => $result]);
})->name('kit.search');
Route::view('/', 'dashboard.index-dashboard')->name('index-dashboard');




Route::view('/register', 'auth.register')->name('register');
Route::view('/settings', 'dashboard.settings')->name('settings');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Fake login/redirect logic for demonstration
Route::post('/login', fn() => redirect()->route('dashboard'));

Route::post('/users', function (Request $request) {
    // Send data to internal API (via controller/service directly instead of Http::post)
    $controller = app(App\Http\Controllers\TrumeLabsController::class);
    $response = $controller->createUser($request);

    // Optionally handle success/failure messages here
    if ($response->status() === 200 || $response->status() === 201) {
        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    return back()->withErrors(['error' => 'Failed to create user.'])->withInput();
})->name('users.store');




Route::put('/patch-user/{id}', function (Request $request, $id) {
    $controller = app(TrumeLabsController::class);
    return $controller->updateUser($request, $id);
})->name('users.update');



// Mock user list for dashboard view (testing)s
Route::view('/users', 'dashboard.users', [
    'users' => [
        (object) [
            'id' => 82173922381839,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'date_of_birth' => '1994-06-17',
            'allow_trume_login' => false,
            'biological_sex' => 'Male',
            'gender' => 'Male',
            'country' => 'United States Of America',
            'ethnicity' => 'White'
        ],
        (object) [
            'id' => 36423218313201,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1992-03-25',
            'allow_trume_login' => true,
            'biological_sex' => 'Female',
            'gender' => 'Female',
            'country' => 'Canada',
            'ethnicity' => 'Asian'
        ],
        (object) [
            'id' => 36423218313201,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1992-03-25',
            'allow_trume_login' => true,
            'biological_sex' => 'Female',
            'gender' => 'Female',
            'country' => 'Canada',
            'ethnicity' => 'Asian'
        ],
        (object) [
            'id' => 36423218313201,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1992-03-25',
            'allow_trume_login' => true,
            'biological_sex' => 'Female',
            'gender' => 'Female',
            'country' => 'Canada',
            'ethnicity' => 'Asian'
        ],
        (object) [
            'id' => 36423218313201,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1992-03-25',
            'allow_trume_login' => true,
            'biological_sex' => 'Female',
            'gender' => 'Female',
            'country' => 'Canada',
            'ethnicity' => 'Asian'
        ],
    ]
])->name('users');


Route::get('/users/{id}', function ($id) {
    $controller = app(TrumeLabsController::class);
    $user = $controller->showUser($id);

    return view('users.show', compact('user'));
})->name('users.show.web'); // optional alternative name


Route::get('/users/{id}', function ($id) {
    $controller = app(TrumeLabsController::class);
    $user = $controller->showUser($id);

    return view('users.show', compact('user'));
})->name('users.show.web');



Route::get('/kits', function () {
    $kitQuery = request('kit_query');
    // Fetch unregistered kits from TrumeLabs API
    $controller = app(TrumeLabsController::class);
    $unregisteredKitsResponse = $controller->getUnregisteredKits();
    $unregisteredKits = $unregisteredKitsResponse->getData(); // decode JSON response

    // Static registered kits data
    $registeredKits = [
        $registeredKits =
        [
            'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
            'user' => 'John Doe',
            'user_details' => [
                'id' => "21974872103",
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'gender' => 'Male',
                'biological_sex' => 'Male',
                'date_of_birth' => '1994-06-17',
                'country' => 'United States',
                'ethnicity' => 'White',
                'allow_trume_login' => true,
            ]
        ],
        [
            'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
            'user' => 'Jane Doe',
            'user_details' => [
                'id' => "12389743210",
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'gender' => 'Female',
                'biological_sex' => 'Female',
                'date_of_birth' => '1994-06-17',
                'country' => 'United States',
                'ethnicity' => 'White',
                'allow_trume_login' => true,
            ]
        ],
        [
            'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
            'user' => 'John Doe',
            'user_details' => [
                'id' => "21974872103",
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'gender' => 'Male',
                'biological_sex' => 'Male',
                'date_of_birth' => '1994-06-17',
                'country' => 'United States',
                'ethnicity' => 'White',
                'allow_trume_login' => true,
            ]
        ],
        [
            'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
            'user' => 'Jane Doe',
            'user_details' => [
                'id' => "12389743210",
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'gender' => 'Female',
                'biological_sex' => 'Female',
                'date_of_birth' => '1994-06-17',
                'country' => 'United States',
                'ethnicity' => 'White',
                'allow_trume_login' => true,
            ]
        ],
    ];

    // Static results data
    $results = [
        'bio_age_results' => [
            [
                'kit_barcode' => 'TEST1',
                'chronological_age' => 30.4,
                'biological_age' => 40.0,
                'peer_biological_age_score' => 50.0,
                'collection_date' => '2024-11-11T18:30:12.313127',
                'share_link' => 'http://app.local/share/VaRwlU0M08ISJy',
            ],
        ],
        'genetic_results' => [
            [
                'kit_barcode' => 'TESTSUP',
                'markers' => [
                    [
                        'marker' => 'rs1801131',
                        'risk' => 'homozygous_normal',
                        'gene' => 'MTHFR',
                        'position' => 'A1298C (Glu429Ala)',
                    ],
                    [
                        'marker' => 'rs1801133',
                        'risk' => 'homozygous_risk',
                        'gene' => 'MTHFR',
                        'position' => 'C677T (Ala222Val)',
                    ],
                ],
            ]
        ]
    ];

    return view('dashboard.kits', compact('registeredKits', 'unregisteredKits', 'results', 'kitQuery'))
        ->with('globalRole', 'admin');
})->name('kits');


Route::post('/settings/generate-kit', function (\Illuminate\Http\Request $request) {
    Http::withHeaders([
        'App-Key' => '1234',
        'Content-Type' => 'application/json',
    ])->post('http://localhost:8080/v1/generate-kits', [
                'barcode' => $request->barcode,
                'test_type' => (int) $request->test_type,
            ]);

    return back()->with('success', 'Test kit generated.');
})->name('settings.generate-kit');

Route::post('/settings/mock-kit', function (\Illuminate\Http\Request $request) {
    Http::withHeaders([
        'App-Key' => '1234',
        'Content-Type' => 'application/json',
    ])->post('http://localhost:8080/v1/mock-kit-result', [
                'barcode' => $request->barcode,
            ]);

    return back()->with('success', 'Mock kit result triggered.');
})->name('settings.mock-kit');
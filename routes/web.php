<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes return frontend views or static test data for display.
*/

Route::get('/', fn() => view('auth.login'))->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/settings', 'dashboard.settings')->name('settings');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Fake login/redirect logic for demonstration
Route::post('/login', fn() => redirect()->route('dashboard'));
Route::post('/users', fn() => redirect()->route('users'))->name('users.store');
Route::put('/users/{id}', fn($id) => redirect()->route('users')->with('success', 'User updated (fake).'))->name('users.update');

// Mock user list for dashboard view (testing)
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

use Illuminate\Http\Request;
// Mock kit and results display for testing purposes
Route::get('/kits', function (Request $request) {
    $kitQuery = $request->input('kit_query');
    $registeredKits = [
        [
            'barcode' => '1234',
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
            'barcode' => '4567',
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

    $unregisteredKits = [
        'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
        'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
    ];


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

    $filteredKits = [];
    if ($kitQuery) {
        $filteredKits = collect($registeredKits)->filter(function ($kit) use ($kitQuery) {
            return Str::contains(strtolower($kit['barcode']), strtolower($kitQuery))
                || Str::contains(strtolower($kit['user']), strtolower($kitQuery));
        })->values()->all();
    }

    return view('dashboard.kits', [
        'registeredKits' => $filteredKits,
        'kitQuery' => $kitQuery,
        'unregisteredKits' => $unregisteredKits,
        'results' => $results,
        'globalRole' => 'admin',   // or whatever you pass in now
    ]);

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
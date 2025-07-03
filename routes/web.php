<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes return frontend views or static test data for display.
*/

Route::get('/', fn () => view('auth.login'))->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/settings', 'dashboard.settings')->name('settings');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Fake login/redirect logic for demonstration
Route::post('/login', fn () => redirect()->route('dashboard'));
Route::post('/users', fn () => redirect()->route('users'))->name('users.store');
Route::put('/users/{id}', fn ($id) => redirect()->route('users')->with('success', 'User updated (fake).'))->name('users.update');

// Mock user list for dashboard view (testing)
Route::view('/users', 'dashboard.users', [
    'users' => [
        (object) [
            'id' => 1,
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
            'id' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'date_of_birth' => '1992-03-25',
            'allow_trume_login' => true,
            'biological_sex' => 'Female',
            'gender' => 'Female',
            'country' => 'Canada',
            'ethnicity' => 'Asian'
        ]
    ]
])->name('users');

// Mock kit and results display for testing purposes
Route::get('/kits', function () {
    $registeredKits = [
        [
            'barcode' => 'KIT123456',
            'user' => 'John Doe',
            'user_details' => [
                'id' => 1,
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
            'barcode' => 'KIT654321',
            'user' => 'Jane Doe',
            'user_details' => [
                'id' => 2,
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
        'KIT_BARCODE_1',
        'KIT_BARCODE_2',
        'KIT_BARCODE_3',
        'KIT_BARCODE_4',
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

    return view('dashboard.kits', compact('registeredKits', 'unregisteredKits', 'results'));
})->name('kits');

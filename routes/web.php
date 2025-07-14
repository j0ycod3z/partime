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

Route::get('/', fn() => view('auth.login'))->name('login');
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
})->name('users.show.web'); // optional alternative name
// Mock kit and results display for testing purposes
// Route::get('/kits', function () {
//     $registeredKits = [
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//             'user' => 'John Doe',
//             'user_details' => [
//                 'id' => "21974872103",
//                 'first_name' => 'John',
//                 'last_name' => 'Doe',
//                 'email' => 'john@example.com',
//                 'gender' => 'Male',
//                 'biological_sex' => 'Male',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//         [
//             'barcode' => 'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//             'user' => 'Jane Doe',
//             'user_details' => [
//                 'id' => "12389743210",
//                 'first_name' => 'Jane',
//                 'last_name' => 'Doe',
//                 'email' => 'jane@example.com',
//                 'gender' => 'Female',
//                 'biological_sex' => 'Female',
//                 'date_of_birth' => '1994-06-17',
//                 'country' => 'United States',
//                 'ethnicity' => 'White',
//                 'allow_trume_login' => true,
//             ]
//         ],
//     ];

//     $unregisteredKits = [
//         'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
//         'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//         'KIT-6A1B3C4D5E7F2C9B1E8D7A6F4C2B9E3F1A7C6D5E9B3A1F8D6C7B2E9A3F',
//         'KIT-9E8D7C6B5A4F1B9C3D7A2E6F8C4B1D9E3F7A6C2B8D1F3E9C7A2B5F6D1E',
//         'KIT-7D4F2E8C3B1A6F9E2D7C4B3F1A9D8E6C7B5F3A2E1D4C9B8F7A6E3C1D2F',
//         'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//         'KIT-A8F7C6E5D4B3A2F1C9E8D7B6F3A1C4D2E9B5A7F6C3E1D4B8A9F2C7E6B5',
//         'KIT-F2D8A9C7B5E6F3A4D1C9B8E2F7A6D3C1B4E5F9A8D2C7B6F1E4A3C5B9D7',
//         'KIT-1C4D3E8F2B7A9D5C6E1F3A8B9C2D7E6F4A1B5C3E9D7F8A2B6C1D3E4F9B',
//         'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
//         'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//         'KIT-6A1B3C4D5E7F2C9B1E8D7A6F4C2B9E3F1A7C6D5E9B3A1F8D6C7B2E9A3F',
//         'KIT-9E8D7C6B5A4F1B9C3D7A2E6F8C4B1D9E3F7A6C2B8D1F3E9C7A2B5F6D1E',
//         'KIT-7D4F2E8C3B1A6F9E2D7C4B3F1A9D8E6C7B5F3A2E1D4C9B8F7A6E3C1D2F',
//         'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//         'KIT-A8F7C6E5D4B3A2F1C9E8D7B6F3A1C4D2E9B5A7F6C3E1D4B8A9F2C7E6B5',
//         'KIT-F2D8A9C7B5E6F3A4D1C9B8E2F7A6D3C1B4E5F9A8D2C7B6F1E4A3C5B9D7',
//         'KIT-1C4D3E8F2B7A9D5C6E1F3A8B9C2D7E6F4A1B5C3E9D7F8A2B6C1D3E4F9B',
//         'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
//         'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//         'KIT-6A1B3C4D5E7F2C9B1E8D7A6F4C2B9E3F1A7C6D5E9B3A1F8D6C7B2E9A3F',
//         'KIT-9E8D7C6B5A4F1B9C3D7A2E6F8C4B1D9E3F7A6C2B8D1F3E9C7A2B5F6D1E',
//         'KIT-7D4F2E8C3B1A6F9E2D7C4B3F1A9D8E6C7B5F3A2E1D4C9B8F7A6E3C1D2F',
//         'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//         'KIT-A8F7C6E5D4B3A2F1C9E8D7B6F3A1C4D2E9B5A7F6C3E1D4B8A9F2C7E6B5',
//         'KIT-F2D8A9C7B5E6F3A4D1C9B8E2F7A6D3C1B4E5F9A8D2C7B6F1E4A3C5B9D7',
//         'KIT-1C4D3E8F2B7A9D5C6E1F3A8B9C2D7E6F4A1B5C3E9D7F8A2B6C1D3E4F9B',
//         'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
//         'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//         'KIT-6A1B3C4D5E7F2C9B1E8D7A6F4C2B9E3F1A7C6D5E9B3A1F8D6C7B2E9A3F',
//         'KIT-9E8D7C6B5A4F1B9C3D7A2E6F8C4B1D9E3F7A6C2B8D1F3E9C7A2B5F6D1E',
//         'KIT-7D4F2E8C3B1A6F9E2D7C4B3F1A9D8E6C7B5F3A2E1D4C9B8F7A6E3C1D2F',
//         'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//         'KIT-A8F7C6E5D4B3A2F1C9E8D7B6F3A1C4D2E9B5A7F6C3E1D4B8A9F2C7E6B5',
//         'KIT-F2D8A9C7B5E6F3A4D1C9B8E2F7A6D3C1B4E5F9A8D2C7B6F1E4A3C5B9D7',
//         'KIT-1C4D3E8F2B7A9D5C6E1F3A8B9C2D7E6F4A1B5C3E9D7F8A2B6C1D3E4F9B',
//         'KIT-8F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F3C1A7E9D2B4A6F',
//         'KIT-4F2A9D8C7E6B1D3C8F2A9E6B7D4C1F8A3E9C2B7D1E6F3A9B6D2F7C4A8E',
//         'KIT-6A1B3C4D5E7F2C9B1E8D7A6F4C2B9E3F1A7C6D5E9B3A1F8D6C7B2E9A3F',
//         'KIT-9E8D7C6B5A4F1B9C3D7A2E6F8C4B1D9E3F7A6C2B8D1F3E9C7A2B5F6D1E',
//         'KIT-7D4F2E8C3B1A6F9E2D7C4B3F1A9D8E6C7B5F3A2E1D4C9B8F7A6E3C1D2F',
//         'KIT-3A9F8D7E6C5B2D1A4F7C3E8B9D2F1A6C5B7E3D9A8F2C1B4E7D6C3F1A9B',
//         'KIT-A8F7C6E5D4B3A2F1C9E8D7B6F3A1C4D2E9B5A7F6C3E1D4B8A9F2C7E6B5',
//         'KIT-F2D8A9C7B5E6F3A4D1C9B8E2F7A6D3C1B4E5F9A8D2C7B6F1E4A3C5B9D7',
//         'KIT-1C4D3E8F2B7A9D5C6E1F3A8B9C2D7E6F4A1B5C3E9D7F8A2B6C1D3E4F9B',
//     ];


//     $results = [
//         'bio_age_results' => [
//             [
//                 'kit_barcode' => 'TEST1',
//                 'chronological_age' => 30.4,
//                 'biological_age' => 40.0,
//                 'peer_biological_age_score' => 50.0,
//                 'collection_date' => '2024-11-11T18:30:12.313127',
//                 'share_link' => 'http://app.local/share/VaRwlU0M08ISJy',
//             ],
//         ],
//         'genetic_results' => [
//             [
//                 'kit_barcode' => 'TESTSUP',
//                 'markers' => [
//                     [
//                         'marker' => 'rs1801131',
//                         'risk' => 'homozygous_normal',
//                         'gene' => 'MTHFR',
//                         'position' => 'A1298C (Glu429Ala)',
//                     ],
//                     [
//                         'marker' => 'rs1801133',
//                         'risk' => 'homozygous_risk',
//                         'gene' => 'MTHFR',
//                         'position' => 'C677T (Ala222Val)',
//                     ],
//                 ],
//             ]
//         ]
//     ];

//     return view('dashboard.kits', compact('registeredKits', 'unregisteredKits', 'results'));
// })->name('kits');



Route::get('/kits', function () {
    // Fetch unregistered kits from TrumeLabs API
    $controller = app(TrumeLabsController::class);
    $unregisteredKitsResponse = $controller->getUnregisteredKits();
    $unregisteredKits = $unregisteredKitsResponse->getData(); // decode JSON response

    // Static registered kits data
    $registeredKits = [$registeredKits = 
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

    return view('dashboard.kits', compact('registeredKits', 'unregisteredKits', 'results'))
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
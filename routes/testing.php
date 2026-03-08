<?php

use TheFramework\App\Router;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Controllers\ContractApiController;
use TheFramework\Middleware\CsrfMiddleware;
use TheFramework\Middleware\WAFMiddleware;


// https://8080-firebase-kolam-renang-1770349115194.cluster-qxqlf3vb3nbf2r42l5qfoebdry.cloudworkstations.dev/data

Router::add('GET', '/data', ContractApiController::class, 'data', [WAFMiddleware::class]);
Router::add('POST', '/data/form', ContractApiController::class, 'kirimForm', [WAFMiddleware::class, CsrfMiddleware::class]);
// Router::add('GET', '/dashboard', ContractApiController::class, 'index', [WAFMiddleware::class]);
// Router::add('POST', '/register/process', ContractApiController::class, 'process', [WAFMiddleware::class, CsrfMiddleware::class]);


// Router::add('GET', '/contract', ContractApiController::class, 'contract', [WAFMiddleware::class]);
// Router::add('GET', '/notif', ContractApiController::class, 'notif', [WAFMiddleware::class]);

// Router::add('GET', '/mada', function () {
//     // return Helper::json([
//     //     'title' => 'ini halaman mada',
//     //     "name" => "Budi Santoso",
//     //     "email" => "budi@example.com",
//     //     "price" => 50000,
//     //     "htmlContent" => "<strong>Teks Bold</strong>",
//     //     "user" => null
//     // ]);

//     return View::render('latihan.mada', [
//         'title' => 'ini halaman mada',
//         "name" => "lalalala",
//         "email" => "parel@example.com",
//         "price" => 60000,
//         "htmlContent" => "<a href='/adek_mada'>adek mada</a>",
//         "user" => null
//     ]);
// });
// Router::add('GET', '/adek_mada', function () {
//     // return Helper::json([
//     //     // 'title' => 'ini halaman adek mada',
//     //     'user' => User::limit(1, 0)->first(),
//     //     'users' => User::all(),
//     //     'roles' => Role::all()
//     // ]);

//     return View::render('latihan.adek_mada', [
//         'title' => 'ini halaman adek mada',
//         'user' => User::limit(1, 0)->first(),
//         'users' => User::all(),
//         'roles' => Role::all()
//     ]);
// });



















// use TheFramework\Http\Controllers\HomeController;
// use TheFramework\Http\Controllers\ApiHomeController;
// // UTILITIES

// Router::add('GET', '/users', HomeController::class, 'Users', [WAFMiddleware::class, LanguageMiddleware::class]);

// Router::group(
//     [
//         'prefix' => '/users',
//         'middleware' => [
//             CsrfMiddleware::class,
//             WAFMiddleware::class,
//             LanguageMiddleware::class
//         ]
//     ],
//     function () {
//         Router::add('POST', '/create', HomeController::class, 'CreateUser');
//         Router::add('POST', '/update/{uid}', HomeController::class, 'UpdateUser');
//         Router::add('POST', '/delete/{uid}', HomeController::class, 'DeleteUser');
//         Router::add('GET', '/information/{uid}', HomeController::class, 'InformationUser');
//     }
// );

// Router::group(
//     [
//         'prefix' => '/api',
//         'middleware' => [
//             ApiAuthMiddleware::class,
//             LanguageMiddleware::class
//         ]
//     ],
//     function () {
//         Router::add('GET', '/users', ApiHomeController::class, 'Users');
//         Router::add('GET', '/users/{uid}', ApiHomeController::class, 'InformationUser');
//         Router::add('POST', '/users/create', ApiHomeController::class, 'CreateUser');
//         Router::add('POST', '/users/update/{uid}', ApiHomeController::class, 'UpdateUser');
//         Router::add('POST', '/users/delete/{uid}', ApiHomeController::class, 'DeleteUser');
//     }
// );

// // --- 🛠️ ERROR PAGE PREVIEW (LOCAL ONLY) 🛠️ ---
// if (\TheFramework\App\Config::get('APP_ENV') === 'local') {
//     Router::group(['prefix' => '/test-error'], function () {
//         Router::add('GET', '/403', function () {
//             \TheFramework\Http\Controllers\Services\ErrorController::error403();
//         });
//         Router::add('GET', '/404', function () {
//             \TheFramework\Http\Controllers\Services\ErrorController::error404();
//         });
//         Router::add('GET', '/500', function () {
//             \TheFramework\Http\Controllers\Services\ErrorController::error500();
//         });
//         Router::add('GET', '/payment', function () {
//             \TheFramework\Http\Controllers\Services\ErrorController::payment();
//         });
//         Router::add('GET', '/maintenance', function () {
//             \TheFramework\Http\Controllers\Services\ErrorController::maintenance();
//         });
//         Router::add('GET', '/database', function () {
//             throw new \TheFramework\App\DatabaseException(
//                 "Koneksi gagal ke 'framework_test'",
//                 500,
//                 null,
//                 ['DB_HOST' => 'localhost', 'DB_PORT' => '3306'],
//                 ['DB_NAME' => 'Kemungkinan Typo di .env']
//             );
//         });
//         Router::add('GET', '/exception', function () {
//             throw new Exception("Ini adalah contoh Pengecualian Sistem (Exception).");
//         });
//         Router::add('GET', '/fatal', function () {
//             // Memicu ParseError (Fatal)
//             eval ('syntax error here');
//         });
//     });
// }

<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FortifyController;
use App\Http\Controllers\RegisterController;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactController::class, 'index']);
// Route::match(['get', 'post'], '/', [ContactController::class, 'index']);

Route::post('/confirm', [ContactController::class, "confirm"]);
Route::post('/thanks', [ContactController::class, "store"]);
Route::post('/register', [RegisterController::class, 'storeUser']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [FortifyController::class, 'index']);
    Route::delete('/admin', [FortifyController::class, 'destroy']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});



// Route::post(
//     '/register',
//     function (RegisterRequest $request, CreateNewUser $creator) {
//         $user = $creator->create($request->validated());
//         return redirect('/login');
//     }
// );

// Route::post('/login', function (LoginRequest $request) {
//     if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
//         $request->session()->regenerate();
//         return redirect('/admin');
//     }
// });

// Route::post('/logout', function (Request $request) {
//     Auth::logout();
//     $request->session()->invalidate();
//     $request->session()->regenerateToken();
//     return redirect('/login');
// });

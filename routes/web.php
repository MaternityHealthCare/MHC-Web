<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');



Route::resource('profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user', 'fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::get('/user-predictions', [HomeController::class, 'getUserPredictions']);

Route::get('report', 'App\Http\Controllers\HomeController@report')->middleware(['user', 'fireauth']);
Route::get('previousreport', 'App\Http\Controllers\HomeController@previousreport')->middleware(['user', 'fireauth']);
Route::get('about', 'App\Http\Controllers\HomeController@about')->middleware(['user', 'fireauth']);
Route::get('scan', 'App\Http\Controllers\HomeController@scan')->middleware(['user', 'fireauth']);
Route::get('/', function () {
    return view('welcome');
});
Route::post('uploadimg', [HomeController::class, 'uploadImage'])->name('uploadimg');
Route::post('growthprediction', [HomeController::class, 'growthprediction'])->name('growthprediction');
Route::get('growth', function () {
    return view('growth');
});
Route::get('gender', function () {
    return view('gender');
});
Route::get('/about', function () {
    return view('aboutsoftware');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/privacy', function () {
    return view('privacypolicy');
});
Route::get('/term', function () {
    return view('termsofuse');
});
Route::get('changepassword', function () {
    return view('auth.changepassword');
});
Route::get('newpassword', function () {
    return view('auth.newpassword');
});
//Route::delete('destroy/{userId}', 'HomeController@destroy')->name('destroy');
Route::delete('/destroy/{userId}/{date}', 'App\Http\Controllers\HomeController@destroy')->name('destroy');

Route::post('/contact', 'App\Http\Controllers\HomeController@sendContactMessage');
Route::get('/all-users', [HomeController::class, 'getAllUsers'])->name('allUsers');

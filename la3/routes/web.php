<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(Auth::check())
    return view('welcome');
    return view('login');
    // or another approach like below
    // return redirect(route('login'));

})->name('home');

use App\Http\Controllers\AuthenticationController; /*Note: You must write all the names
in the path Capitalized which means even "app" which is in small letters write it in capital or it will not work*/

Route::get('/login',[AuthenticationController::class,'login'])->name("login");
Route::post('/login',[AuthenticationController::class,'loginPost'])->name("login.post"); 
// this function will be executed when you click on the button in login page using post method
Route::get('/registration',[AuthenticationController::class,'registration'])->name("registration");
Route::post('/registration',[AuthenticationController::class,'registrationPost'])->name("registration.post"); 
Route::get('/logout',[AuthenticationController::class,'logout'])->name("logout"); // to use when I want to logout


// Imagine you have multiple pages and you want to prevent the access to these pages if the user is not logged in
// You can do a group which is easier than writing for each page to access or redirect to log in.
Route::group(['middleware'=>'auth'], function(){
    Route::get('/profile', function(){
        return "You Can't access the profile if you are not logged in";
    });

    Route::get('/whatever', function(){
        return "You Can't access whatever if you are not logged in";
    });

});
    
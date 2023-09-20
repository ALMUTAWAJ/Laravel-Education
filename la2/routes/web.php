<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;

// I have prevented the login and register pages to be accessed in their functions if the user has already logged in
Route::get('/register',[AuthenticationController::class,'register'])->name('register');
Route::post('/register',[AuthenticationController::class,'registerPost'])->name('register.post');
Route::get('/login',[AuthenticationController::class,'login'])->name('login');
Route::post('/login',[AuthenticationController::class,'loginPost'])->name('login.post'); 



// to prevent the pages to be seen if the user has not logged in yet (The user automatically will be directed to the login page)
Route::group(['middleware'=>'auth'], function(){
    
    // Those are the internal pages after the user being logged in, they will be accessible.
    Route::get('/', [StaticController::class, 'homePage'])->name('home');
    Route::resource('Student', StudentController::class);
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::put('/profile',[ProfileController::class,'profileUpdate'])->name('profile.update'); // use put when update entire table and patch if partially(only particular fields)
});

?>
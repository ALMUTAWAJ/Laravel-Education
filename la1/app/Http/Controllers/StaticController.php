<?php
# to create a file like this one, you can use the command "php artisan make:controller nameOfTheFile"
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    // each function return a page 
    // these functions are used in other pages
    // like web.php  
    public function index()
    {
        return view('welcome');
    }


    public function about()
    {
        return view('about');
    }


    public function contact()
    {
        return view('contact');
    }


}

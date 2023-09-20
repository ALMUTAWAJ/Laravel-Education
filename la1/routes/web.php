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


// ⁡⁢⁣Muntadher notes starts here 
// Web.php is simply a php file that defines paths of pages
// Route is a class you are using from it a static method "get" which takes two parameters,
// the first parameter a route (path) that you define it [Note that '/' means main page], and the second parameter is a function
// that returns what will be shown in that route or path you have defined in the first parameter of the function
// you can simply return any text or html code or a whole file like return view('welcome) which is a file with
// the name welcome.blade.php located in the resources/views of the laravel folder

/*
Route::get('/', function () {
    return view("Welcome"); // You can even return <h1>Welcome</h1> or whatever text
});

// Same thing here, "/about" is the path of the content and the function returns the content which is a page in
// resources/views
Route::get('/about', function () {
    return view("about");
});


Route::get('/contact', function () {
    return view("contact");
});
*/


// instead of putting a function like the commented code above, use the below method better because
// using the controller the code will be arranged in a better way

use App\Http\Controllers\StaticController; // here we have access to the StatiController file

// instead of a function in the second parameter we put a matrix
// the matrix first element is the class from the file StaticController
// and the second element of the matrix is name of the method in that class

// if you just go to the controller file you will notice that the functions index, about, and contact
// will return the pages which located in the views folder
// these names "->name" you can use it as connector to the routes,
// so that the when you have to put a url you can use the names 
Route::get('/',[StaticController::class, 'index'])->name("home.index"); 

Route::get('/about', [StaticController::class, 'about'])->name("home.about");

Route::get('/contact', [StaticController::class, 'contact'])->name("home.contact");

use App\Http\Controllers\ComputersController;

Route::resource('PC', ComputersController::class);
// when you call the route for example in <a> tag you must determine the function e.g. PC.index



// ⁡⁢⁣⁢The following methodology is to use the request using slashes instead of ?requestName=value
// You must write the path you want it and put curly brackets {} between them to mention it as request
// then pass the variables that you put curly brackets between them in the function to use them
// putting question mark ? after the request name in the curly brackets make it optional to write
// in another words we can say they can be null
Route::get('/store/{category?}/{item?}', function ($category = null, $item = null) {
   if(isset($item))
    return "<h1>$item</h1>";
    else if (isset($category))
    return "<h1>$category</h1>";
    else return "<h1>Store</h1>";
});


/*
The below methodology is to use the request to be shown in the url in this way 
?nameOfRequest = valueOfRequest in the url bar 
Route::get('/store', function () {
    $filter = request("style"); ⁡⁣⁢⁢// request is shown as /?nameOfRequest=valueOfRequest in the url bar⁡
⁡⁣⁢⁢// request() is a function that specify the route and show a particular thing according to that route⁡
if(!isset($filter)) ⁡⁣⁢⁢// it is set when the style haas a value in the url like style=value else it is not set⁡
    return "You are viewing all products";
return "<span style='color:red'>This page is viewing ".strip_tags($filter)."</span>";
⁡⁣⁢⁢// strip_tags function removes the tags for security purposes⁡
});

*/
<?php

namespace App\Http\Controllers;

use App\Models\User; // to use the model (already existed model by laravel) called User and its migration is 2014_10_12_000000_create_users_table
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // for authentication
use Illuminate\Support\Facades\Hash; // for hashing password 
use Illuminate\Support\Facades\Session; // for sessions



class AuthenticationController extends Controller
{
    function login(){ // Note that when you write the route in the search bar you are calling this function.
        if(Auth::check())
            return redirect(route('home'));

        return view('login'); // if there is no authentication
    }

    function registration(){ // Note that when you write the route in the search bar you are calling this function.
        if(Auth::check())
        return redirect(route('home'));

    return view('registration'); // if there is no authentication
    }


// The following steps you must do them: if you want to change the authentication to use another filed of the database table e.g. username instead of email:
    // The steps, if I want to use the username only for login validation, are:
    //    1. Go to the migration file and add the username field and mark it as unique.
    //    2. Go to the User.php which is the model file and add the username in the $fillable array.
    //    3. Go to the controller class and add the function username() and return 'username' so that the original function will be overridden.
    //    4.  Lastly, I simply do the authentication in another function.
        
    //    While If I want to use both username and email I just ignore step number 3.
        
    
// this method username() exists and the authentication depends on email by default, if you create this method username() and return 'username'
// then the method username() will be overridden and the username field (attribute or field in the database table) will be used instead email,
//function username(){  
    // the name of the method must be exactly username whatever you are using username field or name or phone-number (because you want to override).  
    //return 'username';
//}




    function loginPost(Request $request){ // in the validate function here you must use the same names of the inputs in the form of the login page 
        $request->validate([
            'emailORusername'=>'required',
            'passwordField'=>'required',
        ]);

        /*

- The "only" method extracts specific values from the request's input data based on the keys you provide.
- Auth::attempt($credentials)` checks if the provided credentials (email and password) match a user in the database, returning true if they match, otherwise false.
- The `intended` function redirects the user to a specified route after successful login, preventing access if the user is not in the database.
- The `with` method associates a session variable with a value, which can then be accessed on the redirected page. */

        // $credentials = $request->only('emailField','passwordField'); // to use "only" method you must change the names of the inputs to be identical with the database table, because only returns an array and the keys in this array will depend on the names if input fields from the request
        // the database table is having email and password then the input names also must be email and password or change the attributes of the databse to be emailField and passwordField
        //The "only" method is called on the $request object. It specifies that you want to extract only the values corresponding to the emailField and passwordField keys from the request's input data.
        //if(Auth::attempt($credentials)){ // will not work if the inputs ofthe name have different names with the table users attributes
          // Auth::attempt($credentials) to check the user attempt, credentials(email, password), if matchs any user in the database will return true ,otherwise return false
        
        
        $email_or_username = $request->emailORusername; // returning the values of the input fields in the login page  
        $pass = $request->passwordField;  
        
        //dd(Hash::make($pass));
        //dd(Auth::attempt(['email' => $email_or_username, 'password' => $pass]));
      




              // Another way to do it instead of using $request->only('','')
            if(Auth::attempt(['email' => $email_or_username, 'password' => $pass])||Auth::attempt(['username' => $email_or_username, 'password' => $pass])){
                 // the keys in the array are related to the names of the database attributes
            return redirect()->intended(route('home')); // intended function will prevent the user to access home route if the user is not in the database (simply alternative to the sessions in normal php)
        }
         return redirect(route('login'))->with('error','Login details are not valid'); 
         // with means associate this variable with you and send it to the login page, the first parameter in the with() function is key and second in value
    }


    function registrationPost(Request $request){
        $request->validate([
            'fullname'=>"required",
            'email'=>"required|email|unique:users,email", // The unique rule for the 'email' field specifies unique:users,email, which means that the email value provided by the user must be unique in the 'email' column of the 'users' table. This ensures that no other user in the database has the same email address.
            'password'=>"required",
            'username' => 'required|string|regex:/^\w*$/|max:32|unique:users,username',
        ]);

        // the names(firstname,email,password) from the request depends on the names given in the form
        // the keys('name, email, password) given for the $data values are depending on the names of the attributes of the table in the migration of the model User
        // the sequence of saving the data in the array $data must be same as the database table
        $data['name'] = $request->fullname; 
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password); // hashing the password 
        $userRegistered = User::create($data); // this will create the user after he entered his data and return true if successfully registered  
        if(!$userRegistered){
            return redirect(route('registration'))->with('error','registration failed try again'); 
        }
        return redirect(route('login'))->with('success','Registration has been done successfully, login to access the features.'); 
    }

    function logout(){ // applied when logout button clicked on 
        Session::flush(); 
        Auth::logout();
        return redirect(route('login')); 
    }

 }
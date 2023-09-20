<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // to retrieve the data from them 
use App\Models\Course;
use Illuminate\Support\Str; // to use the functions in the library
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Session;


class AuthenticationController extends Controller
{
    function login(){
        if(!Auth::check())
        return view('login');
     return view('home');
    }

    function register(){
        if(!Auth::check())
        return view('register');
     return view('home');
    }

    function registerPost(Request $request){
        $request->validate([ 
            'fullname' => 'required|string|min:3|max:64|regex:/^[A-Za-z\s]+$/',
            'email'=>"required|email|unique:users,email", // The unique rule for the 'email' field specifies unique:users,email, which means that the email value provided by the user must be unique in the 'email' column of the 'users' table. This ensures that no other user in the database has the same email address and same thing will be applied for the username below.
            'password' => [
                'required',
                'string',
                'min:8',             // Minimum length of 8 characters
                'confirmed',         // Requires password_confirmation field
                'different:email',  // Password must be different from email
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.@$!%*?&#_-])[A-Za-z\d@$\.!%*?&#_-]+$/',
                // At least one uppercase, one lowercase, one digit, one special character
            ],
            'password_confirmation'=>"required", 
            "planHours" => ['required', 'Integer','max:140','min:66'],
        // By including the confirmed rule, Laravel will automatically look for a field named password_confirmation in your form. This field should contain the confirmed password entered by the user, and Laravel will compare it with the password field to ensure they match. If they don't match, the validation will fail and an error message will be displayed to the user.
        'username' => 'required|string|regex:/^\w*$/|max:24|unique:users,username', // add username column in the users table in the migration and make it unique(because will be used for the authentication), also add username in the $fillable array in User.php model file
        ],
    
        // the second array in the validation can be used for customizing the error message for each field 
        [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ]
    
    );
        // Note that the keys must be same as the database attributes(columns) and same sequence in the database table which is users table
        $data['name'] = $request->fullname; 
        $data['username'] = Str::lower($request->username);
        $data['email'] = Str::lower($request->email);
        $data['password'] = Hash::make($request->password); // You must hash the password 
        $data['plan_hours'] = $request->planHours; 

        $RegisteredFlag = User::create($data); // creating the user (if successful creation the function create will return true else false) 

        if(!$RegisteredFlag){
            return redirect(route('register')); 
        }
        else{// the message will be sent in the variable $successMessage to to the registration page if not applied the validation rules or some mistakes happened
            return redirect(route('login'))->with('successMessage','Congratulations, your account has been created successfully !');
        }

    }

    function loginPost(Request $request){ 
        $request->validate([ // to prevent sending empty string
            'emailOrUsername'=>'required',
            'password'=>'required',
        ]);
        // Do the authentication steps 
        $user_or_email = Str::lower($request ->emailOrUsername);
        $password = $request->password;
         $remember = $request->has('remember'); // if you add another parameter in the Auth::attempt() and if it is true then the user login data will be saved in the cookies for 5 years by default unless he logged out manually
        // when you use Auth::attempt() method you must put an array in the first parameter and the the keys of the values in the array must be same as the keys names in the database
        // check in the database if the username or the password entered is correct then go to the home page else go to login page again 
        if(Auth::attempt(['username' => $user_or_email, 'password' => $password],$remember)||Auth::attempt(['email' => $user_or_email, 'password' => $password], $remember))
            return redirect()->intended(route('home')); // to go to the page quicker if the user already has a failed trial before the successful one
        $identification = 'email';
        if(!str_contains($user_or_email,'@'))
            $identification = 'username';
            return redirect()->back()->withErrors(['loginError' => "Invalid $identification or password"])->withInput($request->only('emailOrUsername', 'password'));

        // the following line is another method but I can use another thing instead to prevent losing the data from the inputs field like the above line
        // return redirect(route('login'))->with('errorMessage',"Your $identification or password are not correct !");
    }

    
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

}

/*
In Laravel, the `intended()` function is used to redirect users to the URL they were trying to access before being redirected to the login page due to authentication requirements. This function is often used after successful authentication to redirect users back to the original URL they were attempting to access.

Here's how it works:

1. When a user tries to access a protected route but is not authenticated, Laravel captures the URL of the route they were trying to access.
2. The user is then redirected to the login page.
3. After successful login, you can use the `intended()` function to redirect the user back to the originally intended URL.

For example, let's say a user tries to access the "/dashboard" route but is redirected to the login page because they are not authenticated. After successful login, you can use the `intended()` function to redirect them back to the "/dashboard" route.

Here's an example of how you might use the `intended()` function in a controller:


use Illuminate\Support\Facades\Auth;

public function login(Request $request)
{
    // Your authentication logic here
    
    if (Auth::check()) {
        // User is authenticated, redirect to intended URL or a default route
        return redirect()->intended('/dashboard');
    }
    
    // If authentication fails, redirect back to login
    return redirect()->route('login')->with('error', 'Authentication failed.');
}


In this example, the `intended()` function checks if there is a previously intended URL for the user. If one exists, it will redirect the user to that URL. If not, it will redirect to the provided default URL ("/dashboard" in this case). This provides a better user experience by taking them back to where they were trying to go before being prompted to log in.
*/

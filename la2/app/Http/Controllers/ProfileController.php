<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB; //used when you will use the other method of using the database


class ProfileController extends Controller
{
    function profile()
    {
        $userID = auth()->user()->id;
        $row = User::where('id', $userID)->first(); // to get the first record 
        //another way to use the database
        //$row = DB::table('users')->where('id',$userID)->first(); 
        //but the returned will be as stdClass so convert it to an array 
        //$row = (array)$row;
        return view('profile', ['userInfo' => $row]);
    }

    function profileUpdate(Request $request)
    {
        $email = $request->email;
        $username = $request->username;

        $rules = [
            'fullname' => 'required|string|min:3|max:64|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'plan_hours' => 'required|integer|min:66|max:132',
            'username' => 'required|string|regex:/^\w*$/|max:24|unique:users,username',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // mimes: is MIME which is the extensions allowed and max is in kb
        ];

        // Apply uniqueness check for email only if it's different from the current user's email
        if ($email == auth()->user()->email) {
            unset($rules['email']); // Remove email uniqueness rule
        }

        // Apply uniqueness check for username only if it's different from the current user's username
        if ($username == auth()->user()->username) {
            unset($rules['username']); // Remove username uniqueness rule
        }

        // Rest of your validation and update logic goes here


        $old_password = $request->old_password;
        $ans = false;
        if (trim($old_password) != "")
            $ans = Hash::check($old_password, auth()->user()->password);

        if ($ans) {
            $rules['new_password'] = [
                'required',
                'string',
                'min:8',
                // Minimum length of 8 characters
                'different:email',
                // Password must be different from email
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.@$!%*?&#_-])[A-Za-z\d@$\.!%*?&#_-]+$/'
            ];
            // At least one uppercase, one lowercase, one digit, one special character
        }

        $request->validate(
            $rules,
            // the second array in the validation can be used for customizing the error message for each field 
            [
                'new_password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            ]

        ); // end of validate function

        // if the photo has been updated 

        if ($request->hasFile('profile_image')) {
            // if the a file uploaded, delete the previous image and will store new image and its path
            if (auth()->user()->profile_image) {
                // Delete the existing profile image before putting a new one
                Storage::disk('public')->delete(auth()->user()->profile_image);
            }
            $image = $request->file('profile_image');
            // Store the uploaded image in the 'public' disk within the 'profile_images' directory
            $path = $image->store('profile-images', 'public'); // the place where the image will be stored at
            $data['profile_image'] = $path; // saving the path in the $data array which will be saved later in the user record
        }
        //dd($request->has('delete_image'));
        if($request->has('delete_image')){
            if($request->delete_image=='1'){
                Storage::disk('public')->delete(auth()->user()->profile_image);
                $data['profile_image'] = null;
            }
        }

        $data['name'] = $request->fullname;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        if ($ans) // to make sure that the user enters the old password and that means the new password has been validated in the validate function 
            $data['password'] = $request->new_password;
        $data['plan_hours'] = $request->plan_hours;

        $user = auth()->user();
        $updatedFlag = $user->update($data); // creating the user (if successful creation the function create will return true else false) 

        if (!$updatedFlag) {
            return redirect()->back()->with('State_F', 'Sorry, your data has not been updated, try again !');
        } else { // the message will be sent in the variable $successMessage to to the registration page if not applied the validation rules or some mistakes happened
            return redirect()->back()->with('State_S', 'Your account data has been updated successfully !');
        }


    } // end of update profile



}
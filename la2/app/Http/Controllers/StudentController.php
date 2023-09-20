<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the authenticated user's username
        $username = auth()->user()->username;
    
        // Retrieve the courses for the authenticated user based on the username
        $authUserCourses = Course::where('user', $username)->get();
    
        return view('students.view_courses', ['courses' => $authUserCourses]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $rule = Rule::unique('courses')->where(function ($query) {
            return $query->where('user', auth()->user()->username); //apply query (Is the code unique when user in the courses table = the current authenticated username?)
        });
        $request->validate([ // validate function contains an array and each field to validate from the request is in a separate array inside the array in the validate function  
            'code' => [
                'required', // the following to make sure that the each user cannot have the course code repeated for the same user
                $rule,
                'regex:/^[A-Za-z0-9]{6,8}$/',
            ],
            'credit' => ['required', 'min:1', 'max:4', 'integer'],
        ]);


        $course = new Course();
        // No need for strip_tags() because the validation is enough 
        $course->user = auth()->user()->username;
        $course->code = strtoupper($request->input('code'));
        $course->credit = $request->input('credit');
        $course->grade = $request->input('grade');
        $course->major = $request->input('major');
        
        $course->save();
        return redirect()->route('Student.create')->withInput($request->except('key'))->with('added','The course has been successfully added.');
        # with() just to send a message in a variable $added
        # withInput($request->except('key)) is to send the inputs that was already coming from the page which is add.blade.php
        # another way to do the above code is as follows 
        // $course['user'] = auth()->user()->username;
        // $course['code'] = strtoupper($request->input('code'));
        // $course['credit'] = $request->input('credit');
        // $course['grade'] = $request->input('grade');
        // $course['major'] = $request->input('major');
        // $CreatedFlag = Course::create($course); 
        // if($CreatedFlag)
        // return redirect()->route('Student.create')->withInput($request->except('key'))->with('added','The course has been successfully added.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $course_id)
    {
        $row = Course::findOrFail($course_id);
        return view('students.edit',['course'=>$row]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->code = strtoupper($request->input('code'));
        $course->credit = $request->input('credit');
        $course->grade = $request->input('grade');
        $course->major = $request->input('major');
        
        $course->save();
        return redirect()->route('Student.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect() -> route("Student.index");

    }
}
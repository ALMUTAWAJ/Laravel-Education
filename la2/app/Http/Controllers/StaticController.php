<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class StaticController extends Controller
{
    public function homePage(){
        $user = auth()->user()->username;
        $plan_hours = auth()->user()->plan_hours;
        // $courses = Course::find($user); // returns single record if found else return false
        $courses = Course::where('user', $user)->get(); // find all records that have user field with same value as $user which is the current authenticated user

        if ($courses->isEmpty()) { //make sure that the returned 2D array is not empty 
            return view('home');
    }

        $credits = 0;
        $majorCredits = 0;
        $gradesByCredits = 0;
        $majorGradesByCredit = 0;

        foreach($courses as $course){
            $credits+=$course->credit;
            $gradesByCredits+=($course->grade)*($course->credit);
            if($course->major=='Yes'){
                $majorCredits+=$course->credit;
                $majorGradesByCredit+=($course->grade)*($course->credit);
            }
          }  
          // find percentage of passed hours, major passed hours, gpa, major gpa, academic status. 
          $major_gpa = ($majorCredits!=0)? ($majorGradesByCredit/$majorCredits) : 0;
          $gpa = ($gradesByCredits/$credits);
          $major_courses_size = $majorCredits/$plan_hours; 
          $passed_percentage = $credits/$plan_hours;
          $info['passed'] = number_format($passed_percentage*100, 2);
          $info['major_courses_size'] = number_format($major_courses_size*100, 2);
          $info['gpa'] = number_format($gpa, 2);
          $info['gpaMajor'] = number_format($major_gpa, 2);

          if($gpa>=3.9)
          {
            $info['performance'] = 'Excellent with first honor rank';
          }
          else if($gpa>=3.7){
            $info['performance'] = 'Excellent with second honor rank';
          }
          else if($gpa>=3.5){
            $info['performance'] = 'Excellent';
          }
          else if($gpa>=3){
            $info['performance'] = 'Very good';
          }
          else if($gpa>=2){
            $info['performance'] = 'Good';
          }
          else{
            $info['performance'] = 'In risk';
          }

          return view('home', compact('info'));
    }
}

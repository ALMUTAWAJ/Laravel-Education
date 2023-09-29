@extends('layout')

@section('add-form')

<link rel="stylesheet" href="{{url('css/add.css')}}">

<x-title title="Update"></x-title>

<div class="add-form">

    <form action="{{route("Student.update", $course->id)}}" method="post">
        @csrf
        @method("PUT")
        <div class="inputField">
            <label for="code">Code</label><br>
             <input value="{{$course->code}}" placeholder="e.g. ITCS333" id='code' name='code' size=40 type="text">
            <div class="error-message">
                @error('code')
                {{$message}}    
                @enderror
            </div>
        </div>
        

        <div class="inputField">
            <label for="credit">Credit</label><br>
             <input value="{{$course->credit}}" placeholder="e.g. 3" id='credit' name='credit' size=40 type="text">
             <div class="error-message">
                @error('credit')
                {{$message}}    
                @enderror
            </div>
        </div>

        <div class="inputField">
            <label for="mark">Grade</label><br>
            <select name="grade" id="mark">
                <option value="4" {{$course->grade=='4'?'selected':""}}>A</option>
                <option value="3.67" {{ $course->grade == '3.67' ? 'selected' : '' }}>A-</option>
                <option value="3.33" {{ $course->grade == '3.33' ? 'selected' : '' }}>B+</option>
                <option value="3" {{ $course->grade == '3' ? 'selected' : '' }}>B</option>
                <option value="2.67" {{ $course->grade == '2.67' ? 'selected' : '' }}>B-</option>
                <option value="2.33" {{ $course->grade == '2.33' ? 'selected' : '' }}>C+</option>
                <option value="2" {{ $course->grade == '2' ? 'selected' : '' }}>C</option>
                <option value="1.67" {{ $course->grade == '1.67' ? 'selected' : '' }}>C-</option>
                <option value="1.33" {{ $course->grade == '1.33' ? 'selected' : '' }}>D+</option>
                <option value="1" {{ $course->grade == '1' ? 'selected' : '' }}>D</option>
                <option value="0" {{ $course->grade == '0' ? 'selected' : '' }}>F</option>
            </select>
        </div>
        
        <div class="inputField">
            <label for="major">Major</label><br>
            <select name="major" id="major">
                <option value="No" {{ $course->major == 'No' ? 'selected' : '' }}>No</option>
                <option value="Yes" {{ $course->major == 'Yes' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
    
        <div align="center" class="add">
            <button type="submit">Update</button>
        </div>
    </form>
    
</div>
@endsection
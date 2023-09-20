@extends('layout')

@section('add-form')

<link rel="stylesheet" href="{{url('css/add.css')}}">

    <h2>
        Enter Course Details: 
    </h2>

<div class="add-form">
    @if(session('added')) {{--If added in the session then the added message will appear.--}}
    <div style='font-size:0.92rem;' class="alert alert-success">
        {{ session('added') }}
        <a href="{{ route('Student.create') }}" class="btn btn-success addMore">Add Another</a>
    </div>
@endif
    
    <form action="{{route("Student.store")}}" method="post">
        @csrf
        <div class="inputField">
            <label for="code">Code</label><br>
             <input value="{{old("code")}}" placeholder="e.g. ITCS333" id='code' name='code' size=40 type="text">
            <div class="error-message">
                @error('code')
                {{$message}}    
                @enderror
            </div>
        </div>
        

        <div class="inputField">
            <label for="credit">Credit</label><br>
             <input value="{{old("credit")}}" placeholder="e.g. 3" id='credit' name='credit' size=40 type="text">
             <div class="error-message">
                @error('credit')
                {{$message}}    
                @enderror
            </div>
        </div>

        <div class="inputField">
            <label for="mark">Grade</label><br>
            <select name="grade" id="mark">
                <option value="4" {{old('grade')=='4'?'selected':""}}>A</option>
                <option value="3.67" {{ old('grade') == '3.67' ? 'selected' : '' }}>A-</option>
                <option value="3.33" {{ old('grade') == '3.33' ? 'selected' : '' }}>B+</option>
                <option value="3" {{ old('grade') == '3' ? 'selected' : '' }}>B</option>
                <option value="2.67" {{ old('grade') == '2.67' ? 'selected' : '' }}>B-</option>
                <option value="2.33" {{ old('grade') == '2.33' ? 'selected' : '' }}>C+</option>
                <option value="2" {{ old('grade') == '2' ? 'selected' : '' }}>C</option>
                <option value="1.67" {{ old('grade') == '1.67' ? 'selected' : '' }}>C-</option>
                <option value="1.33" {{ old('grade') == '1.33' ? 'selected' : '' }}>D+</option>
                <option value="1" {{ old('grade') == '1' ? 'selected' : '' }}>D</option>
                <option value="0" {{ old('grade') == '0' ? 'selected' : '' }}>F</option>
            </select>
        </div>
        
        <div class="inputField">
            <label for="major">Major</label><br>
            <select name="major" id="major">
                <option value="No" {{ old('major') == 'No' ? 'selected' : '' }}>No</option>
                <option value="Yes" {{ old('major') == 'Yes' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
    
        <div align="center" class="add">
            <button type="submit">Add</button>
        </div>
    </form>
    
</div>
@endsection
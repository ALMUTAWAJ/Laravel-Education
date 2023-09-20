@extends("layout")

@section('summary')
<link rel="stylesheet" href="{{url("css/home.css")}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<div class="content">

    <div class="student-summary">

        <h2>Academic Summary: </h2>
    
        @if(isset($info))
        <div class="summary-item">
            General Commulative GPA: <span class="res">{{$info['gpa']}}</span>
        </div>
        
        <div class="summary-item">
            Major Commulative GPA: <span class="res">{{$info['gpaMajor']}}</span>
        </div>

        <div class="summary-item">
        General Courses Progress: <span class="res">{{$info['passed']}}%</span>
        </div>
    
        <div class="summary-item">
            Major Courses Occupation: <span class="res">{{$info['major_courses_size']}}%</span>
        </div>
    
        <div class="summary-item">
            Academic Performance: <span class="res">{{$info['performance']}}</span>
        </div>
    
        </div>
        
        @else
    
        <div class="alert alert-info">
            Please add courses to see your summary !
        </div>
        
        @endif

        <div class="image">
            <span style="font-size: 20rem" class="material-symbols-outlined">
                school
                </span>
        </div>

</div>
@endsection
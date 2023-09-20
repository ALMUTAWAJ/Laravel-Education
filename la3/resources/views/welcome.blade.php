{{-- @if (!Auth::check()) --}}
    {{-- alternative to the session check if session is active or go to login --}}
    {{-- <script>
        window.location.href = '{{ route('login') }}';
    </script> --}}
    {{-- you must add exit() in case you have any other php code under it it will not be executed --}}
    {{-- {{exit();}} --}}
    {{-- if you remove exist(); function you must type @auth @endauth between the code that needs authentication like auth()->user()->name --}}
{{-- @endif --}}

{{-- I have used a better approachthan the above approaches which is using the function of the route itself (in the controller) --}}

@extends('layout')
@section('title', 'Home Page')

@section('content')
    {{-- {{auth()->user();}} this is used to show all the user information from the database while the session is on --}}
    @auth
        {{--  retreive the name from the database by {{ auth()->user()->name }}  --}}
        <span style='margin-left:1rem;color:green;'> Hi <span
                style='color:red;font-weight:bold;'>{{ auth()->user()->name }}</span>, have a nice day 👋🏽! </span>
    @endauth
@endsection

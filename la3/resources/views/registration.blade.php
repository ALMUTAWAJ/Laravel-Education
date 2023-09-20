{{-- @if (Auth::check()) 
<script>
    window.location.href = '{{ route('home') }}'; 
</script>
@endif --}}

{{-- I have used a better approach which is using the function of the route itself (in the controller) --}}

@extends('layout')
@section('title', 'Registration')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

@section('content')
    <div class="container">
        <div class="message mt-5">
            @if ($errors->any()) {{-- automatic errors by laravel --}}
                <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- here is the error and success I have created in the controller which is called AuthenticationController --}}
            @if (session()->has('error')) {{--if the session has the key error which has been associated in the with() function then alert will be shown--}}
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

        </div>
        <form action="{{ route('registration.post') }}" method='post'>
            @csrf
            <div class="mb-3">
                <label for="FullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="FullName" name='fullname' value={{old('fullname')}}>
                <div class="error-message">
                    @error('fullname')
                        <h6 style='color:red'>{{ $message }}</h6>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name='username' value={{old('username')}}>
                <div class="error-message">
                    @error('username')
                        <h6 style='color:red'>{{ $message }}</h6>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="Email" name='email' value={{old('email')}}>
                <div class="error-message">
                    @error('email')
                        <h6 style='color:red'>{{ $message }}</h6>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name='password' value={{old('password')}}>
                <div class="error-message">
                    @error('password')
                        <h6 style='color:red'>{{ $message }}</h6>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

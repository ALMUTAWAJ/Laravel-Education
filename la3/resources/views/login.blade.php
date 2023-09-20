{{-- In summary, the redirect() function is used in the controller or route callbacks to send HTTP redirection responses,
 and it won't work as a direct command within a Blade template. You can use the following two methods instead. --}}
 
{{-- @if (Auth::check()) --}}

     {{-- @php
     # this is the first method to redirect
        header("Location:".route('home'));
        exit();
    @endphp  --}}
    {{-- <script>
        // this is the second method
        window.location.href = '{{ route('home') }}'; // this will redirect to the welcome page 
    //JavaScript for redirection might be more user-friendly as it won't result in a page refresh and provides a smoother transition for the user.
    </script> --}}
{{-- @endif --}}

{{-- But the best method is doing the authentication in the function login of the route itself which exists in a controller which is called AhuthenticationController --}}

@extends('layout')
@section('title', 'Login')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

@section('content')
    <div class="container">

        <div class="mt-5">
            @if ($errors->any()) {{-- automatic errors by laravel --}}
                <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- here is the error and success I have created in the controller which is called Authentication --}}
            @if (session()->has('error'))
                {{-- if the session has the key "error" which has been associated in the with() function then alert will be shown --}}
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form action="{{ route('login.post') }}" method='POST'> {{-- The action is containing the name of the route (The data of the form inputs will be sent to the route of the name login.post)  --}}
            @csrf
            <div class="mb-3">
                <label for="eORu" class="form-label">Email Address or Username</label>
                <input type="text" class="form-control" id="eORu" name='emailORusername' value={{ old('emailORusername') }}>
                <div class="error-message">
                    @error('emailORusername')
                        <h6 style='color:red'>{{ $message }}</h6>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name='passwordField'
                    value={{ old('passwordField') }}>
                <div class="error-message">
                    @error('passwordField')
                        <h6 style='color:red'>{{ $message }}</h6>   
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

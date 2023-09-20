@extends('layout')

@section('register-form')
    <link rel="stylesheet" href='{{ url('css/login_and_register.css') }}'>
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Login 🔐 <br> <br> Statistics is <br />
                        <span style="color: hsl(218, 81%, 75%)">Our Business</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        we aim to give the students comfortable data calculations and analysis about their academic
                        performance in one centeral room.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <div class="message mt-5">
                                @if (session()->has('successMessage'))
                                    {{-- the message I have associated in the with() function --}}
                                    <div class="alert alert-success">
                                        {{ session('successMessage') }}
                                    </div>
                                @endif

                               
                                
                                    {{-- I will just include the error within $error array  --}}
                                    
                                {{-- @if (session()->has('errorMessage'))
                                    <div class="alert alert-danger">
                                        {{ session('errorMessage') }}
                                    </div>
                                @endif --}}


                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger">
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif

                            </div>
                            <form method='post'action='{{route('login.post')}}'>
                                @csrf
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Username or Email Address </label>
                                    <input type="text" id="form3Example3" class="form-control" name='emailOrUsername' value="{{old('emailOrUsername')}}" placeholder="Enter your username or email"/>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control" name='password'  value="{{old('password')}}" placeholder="Enter your password"/>
                                    <input class="form-check-input me-2" type="checkbox" id="showPassword1" />
                                    <label class="form-label" for="showPassword1">Show 👁</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
    <script src="{{url('js/show.js')}}"></script>
@endsection

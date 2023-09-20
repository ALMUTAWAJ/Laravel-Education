@extends('layout')

@section('register-form')
    <link rel="stylesheet" href='{{ url('css/login_and_register.css') }}'>
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Join Our Family 🤝🏻 <br><br> Statistics is <br />
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
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <form method='post' action='{{ route('register.post') }}'>
                                @csrf
                                <!-- 2 column grid layout with text inputs for fullname and username -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">Fullname</label>
                                            <input type="text" id="form3Example1" class="form-control" name='fullname'
                                                value='{{ old('fullname') }}' placeholder="e.g. Mike Stolen" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Username</label>
                                            <input type="text" id="form3Example2" class="form-control" name='username'
                                                value='{{ old('username') }}' placeholder="e.g. Mike_1998" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" class="form-control" name='email'
                                        value='{{ old('email') }}' placeholder="e.g. Mike@welcome.com" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control" name='password'
                                        value='{{ old('password') }}' placeholder="Your Password" />
                                    <input class="form-check-input me-2" type="checkbox" id="showPassword1" />
                                    <label class="form-label" for="showPassword1">Show 👁</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example5">Confirm Password</label>
                                    <input type="password" id="form3Example5" class="form-control"
                                        name='password_confirmation' value='{{ old('password_confirmation') }}'
                                        placeholder="Password Confirmation" />
                                    <input class="form-check-input me-2" type="checkbox" id="showPassword2" />
                                    <label class="form-label" for="showPassword2">Show 👁</label>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="plan">Plan Hours</label>
                                        <input type="text" id="plan" class="form-control" name='planHours'
                                            value='{{ old('planHours') }}' placeholder="e.g. 132" />
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <label class="form-check-label" for="form2Example33">
                                        <input class="form-check-input me-2" type="checkbox" id="form2Example33" />
                                        I Agree to the terms and conditions.
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" id='signup' disabled class="btn btn-primary btn-block mb-4">
                                    Sign up
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
    <script src="{{ url('js/show.js') }}"></script>
@endsection

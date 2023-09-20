@extends('layout')
@section('profile')
    @vite('resources/css/app.css')
    <h1>Edit Profile</h1>
    {{-- The following will show the errors based on the entered data, these errors authomatically generated laravel when you use validate function in the controller. --}}
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



            @if (session()->has('State_S'))
                {{-- the message I have associated in the with() function --}}
                <div class="alert alert-success">
                    {{ session('State_S') }}
                </div>
            @elseif (session()->has('State_F'))
                <div class="alert alert-danger">
                    {{ session('State_F') }}
                </div>
            @endif


            {{-- enctype used because I am using file input type --}}
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                <!-- CSRF Token -->
                @csrf
                <!-- method used for update data -->
                @method('PUT')
                {{-- profile image div --}}
                <div class="relative w-20 h-20 overflow-hidden bg-gray-100 rounded-2 ml-5 mb-3 dark:bg-gray-600">
                    <svg class="absolute w-24 h-24 text-gray-400 -left-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="mb-3">
                <!-- Profile Image with label and input -->
                    <label for="profile_image" class="form-label btn btn-warning">Update Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="fullname"
                        value="{{ old('fullname') != null ? old('fullname') : $userInfo['name'] }}" required>
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username') != null ? old('username') : $userInfo['username'] }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('email') != null ? old('email') : $userInfo['email'] }}" required>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="plan-h" class="form-label">Plan Hours:</label>
                    <input type="text" class="form-control" id="plan-h" name="plan_hours"
                        value="{{ old('plan_hours') != null ? old('plan_hours') : $userInfo['plan_hours'] }}" required>
                </div>

                <div class="change-pass-question mb-3">
                    <a id="link_to_change_pass" href="#">Change password?</a>
                </div>

                <div id="change_pass" style="display:none;">
                    <!-- old Password -->
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password:</label>
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="Old Password">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="password" name="new_password"
                            placeholder="New Password">
                    </div>

                </div>


                <button class="mb-5" type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        <script src="{{ url('js/show_pass.js') }}"></script>
    @endsection

@extends('layout')
@section('profile')
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
                {{-- Note asset function used only for the files in the public folder --}}
                <div class="w-24 h-24 rounded-lg overflow-hidden mb-2 ml-4">
                    <img id="profileImage"
                        src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : url('uploads/avatar.svg') }}"
                        class="w-24 h-24 rounded-lg object-cover" alt="Profile Image">
                </div>
                <h1>Generated Image Path: {{ 'storage/' . Auth::user()->profile_image }}</h1>


                {{-- 


                When you save an image in the "public" directory (not the "public" directory inside the "storage" directory),
                it means that the image is directly accessible via a URL without any additional configuration.

                    Saving Images:

                Security: Placing the images in the "storage" folder can make it more secure since files in
                the "storage" folder are not directly accessible via the web. This can be beneficial if you want to restrict
                access to the default avatar.

                Customization: Storing the default avatar in the "storage" folder allows you to easily customize or change
                it without affecting the public-facing URL. This can be useful if you anticipate needing to update the
                images.

                Saving Default Avatar in the "Public" Folder:

                Simplicity: Placing the images in the "public" folder simplifies the setup because it's
                directly accessible via a URL without additional configurations. This can be convenient, especially for
                small projects or prototypes.

                Performance: Serving the default avatar directly from the "public" folder can be slightly more efficient in
                terms of server load since it doesn't require routing through the Laravel application.

                In general, if security and the ability to easily update the default avatar are important considerations,
                storing it in the "storage" folder might be a better choice. However, if simplicity and performance are more
                important for your project, the "public" folder may be sufficient. --}}


                <div class="mb-3">
                    <!-- Profile Image with label and input -->
                    <label for="profile-image-input" class="btn btn-warning">Update Image</label>
                    <label for="delete-profile-image" onclick="toggleDelete()" class="btn btn-danger">Delete</label>
                    <input type="file" class="form-control" id="profile-image-input" name="profile_image"
                        accept="image/*" onchange hidden>
                    <input type="hidden" name='delete_image' id="delete-profile-image" value='0'>

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


                <button class="mb-5 btn btn-warning" type="submit">Save Changes</button>
            </form>
        </div>
        <script src="{{ asset('js/show_pass.js') }}"></script>
        <script src="{{ asset('js/profile.js') }}"></script>

        <script>
            var assetUrl = "{{ asset('uploads/avatar.svg') }}";
        </script>


    @endsection

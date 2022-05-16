@extends('layouts.adminLayout')
@section('content')
    @include('includes.modal')
    <script>
        function modalMessage(msg) {
            document.querySelector(".modals-message").innerHTML = "<p>" + msg + "</p>";
            document.querySelector(".modals-bg").classList.add("bg-active");
        }
    </script>
    @if(Session::get('status') == 'successful')
        <script>modalMessage("Successfully updated info.");</script>
    @endif

    @if(Session::get('status') == 'failed')
        <script>modalMessage("Failed to update info.");</script>
    @endif

    @include('includes.dashNav')
    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Edit profile</h1>
        <div class="form d-flex justify-content-center align-items-center w-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form onsubmit="return editValidator()" id="loginForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="user_name">Name</label>
                        <input type="text" name="uname" id="user_name" class="uname form-control form-control-lg py-4 fs-4"
                            placeholder="Enter user name" value="{{$userCredential->userInfo->name}}" />
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email_address">Email address</label>
                        <input type="email" name="email" id="email_address" class="dashEmail form-control form-control-lg py-4 fs-4"
                            placeholder="Enter a valid email address" value="{{$userCredential->email}}" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="user_password">Password</label>
                        <input type="password" name="password" id="user_password" class="dashPassword form-control form-control-lg py-4 fs-4"
                            placeholder="To update re-enter password" />
                    </div>

                    <!-- New Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="user_new_password">New Password</label>
                        <input type="password" name="new_password" id="user_new_password" class="dashNewPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter new password" />
                    </div>

                     <!-- Confirm New Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="user_confirm_password">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" id="user_confirm_password" class="dashConfirmPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter to confirm new password" />
                    </div>

                     <!-- Description text -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="description">Modify description</label>
                        <!-- <input type="password" name="confirm_new_password" id="form3Example4" class="loginPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter to confirm new password" /> -->
                            <textarea name="description" id="description" rows="5" class="user_description form-control form-control-lg py-4 fs-4">{{$userCredential->userInfo->description}}</textarea>
                    </div>

                    <!-- upload image -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="image">Upload image</label>
                        <input type="file" name="image" id="image" class="user_image form-control form-control-lg py-4 fs-4">
                    </div>

                    <!-- upload CV -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="cv">Upload CV</label>
                        <input type="file" name="cv" id="cv" class="user_cv form-control form-control-lg py-4 fs-4">
                    </div>
                </form>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="padding: 2rem; font-size: 2rem; 
                        " form="loginForm">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

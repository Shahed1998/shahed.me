@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Edit profile</h1>
        <div class="form d-flex justify-content-center align-items-center w-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form onsubmit="return false" id="loginForm" method="POST" >
                    @csrf

                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Name</label>
                        <input type="text" name="uname" id="form3Example3" class="uname form-control form-control-lg py-4 fs-4"
                            placeholder="Enter user name" />
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Email address</label>
                        <input type="email" name="email" id="form3Example3" class="loginEmail form-control form-control-lg py-4 fs-4"
                            placeholder="Enter a valid email address" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Password</label>
                        <input type="password" name="password" id="form3Example4" class="loginPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter password" />
                    </div>

                    <!-- New Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">New Password</label>
                        <input type="password" name="new_password" id="form3Example4" class="loginPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter new password" />
                    </div>

                     <!-- Confirm New Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" id="form3Example4" class="loginPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter to confirm new password" />
                    </div>

                     <!-- Description text -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Modify description</label>
                        <!-- <input type="password" name="confirm_new_password" id="form3Example4" class="loginPassword form-control form-control-lg py-4 fs-4"
                            placeholder="Enter to confirm new password" /> -->
                            <textarea name="description" id="form3Example4" rows="5" class="form-control form-control-lg py-4 fs-4"></textarea>
                    </div>

                    <!-- Description text -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Upload image</label>
                        <input type="file" name="image" id="form3Example4" class="form-control form-control-lg py-4 fs-4">
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

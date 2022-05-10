@extends('layouts.adminLayout')
@section('content')
    
    @include('includes.modal')

    <script>
        function closeModal() {
            const modalBg = document.querySelector(".modals-bg");
            modalBg.classList.remove("bg-active");
        }

        function modalMessage(msg) {
            document.querySelector(".modals-message").innerHTML = "<p>" + msg + "</p>";
            document.querySelector(".modals-bg").classList.add("bg-active");
        }
    </script>

    @if(Session::has('validationFailedStatus'))
        <script>
            modalMessage("Invalid email or password");
        </script>
    @endif

    @if(Session::has('loginFailedStatus'))
        <script>
            modalMessage("User not found");
        </script>
    @endif

    <section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{asset('images/login.webp')}}"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form onsubmit="return login()" id="loginForm" method="POST" >
                @csrf
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

                <div class="d-flex justify-content-between align-items-center">
                    <a href="#!" class="text-body">Forgot password?</a>
                </div>
            </form>
            <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding: 2rem; font-size: 2rem; 
                    background-color: #df2e2e;" form="loginForm">Login</button>
            </div>
        </div>
        </div>
    </div>
    </section>
@endsection

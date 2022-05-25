@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
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

    @if(Session::get('editProj') == 'successful')
        <script>
            modalMessage("Updated successfully");
        </script>
    @endif

    @if(Session::get('editProj') == 'failed')
        <script>
            modalMessage("Failed to update");
        </script>
    @endif

    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Edit Project</h1>
        <div class="message w-75 mx-auto">
            <form action="" id="editProj" method="post" onsubmit="return projectForm()">
                @csrf
                @method('PUT')
                <label for="projName">Project name:</label><br>
                <input type="text" class="w-100" name="projName" id="projName" value="{{$projects->name}}"><br><br>
                <label for="projLink">Project link:</label><br>
                <input type="text" class="w-100" name="projLink" id="projLink" value="{{$projects->link}}"><br><br>
                
            </form>
            <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding: 2rem; font-size: 2rem; 
                    background-color: #df2e2e;" form="editProj">Edit project</button>
            </div>
        </div>
    </div>
    
@endsection
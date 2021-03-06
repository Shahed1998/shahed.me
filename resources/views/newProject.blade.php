@extends('layouts.adminLayout')
@section('content')

    @include('includes.dashNav')
    @include('includes.modal')

    @if(Session::get('editProj') == 'failed')
        <script>
            modalMessage("Failed to update");
        </script>
    @endif
    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Add Project</h1>
        <div class="message w-75 mx-auto">
            <form action="" id="addProj" method="post" onsubmit="return projectForm()">
                @csrf
                <label for="projName">Project name:</label><br>
                <input type="text" class="w-100" name="projName" id="projName" value=""><br><br>
                <label for="projLink">Project link:</label><br>
                <input type="text" class="w-100" name="projLink" id="projLink" value=""><br><br>
                
            </form>
            <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding: 2rem; font-size: 2rem; 
                    background-color: #df2e2e;" form="addProj">Add project</button>
            </div>
        </div>
    </div>
    
@endsection
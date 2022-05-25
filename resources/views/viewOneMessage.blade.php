@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
    @include('includes.modal')

    @if(Session::get('emailed') == 'successful')
        <script>
            modalMessage("Emailed successfully");
        </script>
    @endif

    @if(Session::get('emailed') == 'failed')
        <script>
            modalMessage("Failed to send email");
        </script>
    @endif

    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Messages</h1>
        <div class="message w-75 mx-auto">
            <label for="name">Name:</label><br>
            <input type="text" class="w-100" name="" id="" disabled value="{{$mailInfo->name}}"><br><br>
            <label for="sub">Subject:</label><br>
            <textarea name="" id="" class="w-100" cols="30" rows="3" disabled >{{$mailInfo->subject}}</textarea><br><br>
            <label for="comment">Comment:</label><br>
            <textarea name="" id="" class="w-100" cols="30" rows="10" disabled >{{$mailInfo->comment}}</textarea><br>
        </div>
        <h2 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Reply</h2>
        <div class="message w-75 mx-auto">
            <form action="" id="sendEmailForm" method="post">
                @csrf
                <label for="mailTo">Mail to:</label><br>
                <input type="text" class="w-100" name="mailTo" id="mailTo" value="{{$mailInfo->email}}"><br><br>
                <label for="sub">Subject:</label><br>
                <textarea name="subject" id="" class="w-100" cols="30" rows="3"></textarea><br><br>
                <label for="body">Body:</label><br>
                <textarea name="body" id="body" class="w-100" cols="30" rows="10" ></textarea><br>
            </form>
            <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                    style="padding: 2rem; font-size: 2rem; 
                    background-color: #df2e2e;" form="sendEmailForm">Send Email</button>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Messages</h1>
        <div class="message ms-3">
            <label for="name">Name:</label><br>
            <input type="text" class="w-75" name="" id="" disabled value="{{$mailInfo->name}}"><br>
            <label for="sub">Subject:</label><br>
            <input type="text" class="w-75" name="" id="sub" disabled value="{{$mailInfo->subject}}"><br>
            <label for="comment">Comment:</label><br>
            <textarea name="" id="" class="w-75" cols="30" rows="10" disabled >{{$mailInfo->comment}}</textarea>
        </div>
        <h2 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Reply</h2>

    </div>
@endsection

<!-- <div class="w-50 mx-auto">
            <label for="name">Name:</label><br>
            <input type="text" name="" size="26" id="name" disabled value="{{$mailInfo->name}}">
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="" id="email" size="26" disabled value="{{$mailInfo->email}}"></td>
                </tr>
                <tr>
                    <td><label for="sub">Subject:</label></td>
                    <td><input type="text" name="" id="sub" size="26" disabled value="{{$mailInfo->subject}}"></td>
                </tr>
                <tr>
                    <td><label for="comment">Comment:</label></td>
                    <td><textarea name="" id="" cols="30" rows="10" disabled >{{$mailInfo->comment}}</textarea></td>
                </tr>
            </table>
        </div> -->
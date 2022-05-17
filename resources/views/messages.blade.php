@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Messages</h1>
        
        <div class="w-100 p-5 d-flex align-items-end justify-content-end">
            <select class="w-50 form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option value="0" selected>New messages</option>
                <option value="1">Older messages</option>
            </select> 
        </div>
        
        <table class="table text-center">
            <thead>
                <th>Email</th>
                <th>Message</th>
            </thead>
            <tbody>
                @foreach($email as $message)
                    <tr>
                        <td>{{$message->email}}</td>
                        <td>{{$message->comment}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$email->links()}}
    </div>
@endsection
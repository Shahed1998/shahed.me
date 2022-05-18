@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')

    <div class="desc editProfile">
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Messages</h1>
        <div class="w-100 p-5 d-flex align-items-end justify-content-end">
            <div class="inner">
                <a href="{{route('messages')}}" class="d-block p-3"><i class="fa-solid fa-envelope"></i> All messages</a>
                <a href="{{route('newMessages')}}" class="link-success d-block p-3">[{{$totalNewMessages}}] New messages</a>
                <a href="{{route('dltAllMsg')}}" class="d-block link-danger p-3"><i class="fa-solid fa-trash-can"></i> Remove all messages</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <!-- <th></th> -->
                <th>Email</th>
                <th>Message</th>
                <th></th>
            </thead>
            <tbody>
                <form action="" id="message_field" method="post">
                @csrf
                @method('DELETE')
                @foreach($email as $message)
                    <tr value="{{$message->id}}">
                        <!-- <td><input class="form-check-input" type="checkbox" name="mailID[]" value="{{$message->id}}" onclick="ajaxCheckbox()"></td> -->
                        @php
                            $userMail = $message->email;
                            if(strlen($userMail) > 5){
                                $userMail = substr($userMail, 0, 8). " ...";
                            }
                        @endphp
    
                        <td><a href="{{route('viewOnePage', ['id'=>$message->id])}}">{{$userMail}}</a></td>
                        
                        @php
                            $messageTable = $message->comment;
                            if(strlen($messageTable) > 10){
                                $messageTable = substr($messageTable, 0, 15). " ...";
                            }
                        @endphp
                        
                        <td><a href="{{route('viewOnePage', ['id'=>$message->id])}}">{{$messageTable}}</a></td>
                        <td><a href="{{route('dltOneMsg', ['id'=>$message->id])}}" class="link-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                    </tr>
                @endforeach
                </form>
            </tbody>
        </table>
        </div>
        {{$email->links()}}
    </div>
@endsection
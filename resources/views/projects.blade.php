@extends('layouts.adminLayout')
@section('content')
    @include('includes.dashNav')
    <div class="desc editProfile">
        
        <h1 class="d-flex justify-content-center align-items-center shadow p-5 mb-5 bg-body rounded">Projects</h1>
        <div class="w-100 p-5 d-flex align-items-end justify-content-end">
            <div class="inner">
                <a href="{{route('newProject')}}" class="d-block p-3"><i class="fa-solid fa-circle-plus"></i> Add new project</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Name [{{$total_projects}}]</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            @php
                                if(strlen($project->name) > 10){
                                    $project->name = substr($project->name,0,10)."...";
                                }
                            @endphp
                           
                            <td>{{$project->name}}</td>
                            <td><a href="{{route('editProject', ['id'=>encrypt($project->id)])}}" class="link-success"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="{{route('deleteProject', ['id'=>encrypt($project->id)])}}" class="link-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
        {{$projects->links()}}
    </div>
    </div>
@endsection
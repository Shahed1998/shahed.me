@extends('layouts.structureLayout')
@section('content')

    @include('includes.preloader')
    @include('includes.modal')
    @include('includes.navbar')

    <div class="desc">
        <div class="container">

            <section id="about">
                <div class="info-wrapper">
                    <img src="" alt="">
                    <h1>{{$name}}</h1>
                    <div class="brief-info">
                        <p>{{$description}}</p>
                        <p>
                            <a href="" class="cv-download" download="Shahed's Demo CV">
                                <i class="fa fa-download"></i> Download CV
                            </a>
                        </p>
                    </div>
                </div>
            </section>

            <section id="projects">
                <div class="section-header">
                    <h2>Projects</h2>
                        <div class="project-container">
                            @foreach($user_projects as $project)
                            <div class="flip-card" onclick="redirector('{{$project->link}}')">
                                <div class="flip-card-inner">
                                    <div class="flip-card-back">
                                        <img src="" alt="" style="width:250px;height:200px;">
                                    </div>
                                    <div class="flip-card-front">
                                        <h3>{{$project->name}}</h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    
                    {{$user_projects->links()}}
                </div>
            </section>

            <section id="contact"> 
                <div class="section-header">
                    <h2>Connect with me</h2>
                </div>
                <div class="grid-container">
                <div class="form-box">
                    <form id="connect" action="" method="POST" autocomplete="off">
                        @csrf
                    <input id="cname" type="text" name="cname" placeholder="Name"/><br/>
                    <input id="email" type="email" name="email" placeholder="Email"/><br/>
                    <input id="subject" type="text" name="subject" placeholder="Subject"/><br/>
                    <textarea id="comment" name="comment" cols="30" rows="8"></textarea>
                    </form>
                    <button class="mailSubmit" onclick="sendEmail()">Submit</button>
                </div>
                <div class="social-links"> 
                    <ul> 
                    <li><a href="https://www.facebook.com/shahed.chowdhury.50767" target="_blank"> Facebook <i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/shahed-chowdhury-omi-0042711aa/" target="_blank"> LinkedIn <i class="fab fa-linkedin"></i></a></li>
                    <li><a href="https://github.com/Shahed1998" target="_blank"> Github <i class="fab fa-github"></i></a></li>
                    </ul>
                </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer')
@endsection

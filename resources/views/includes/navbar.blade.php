    <div class="nav">
        <div class="hamburger">
            <div class="container" onclick="navLinks()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div> 
        <div class="nav-links">
            @foreach($links as $key=>$value)
                <a href="#{{strtolower($value->link_names)}}"> 
                    <i class="fas fa-chevron-circle-right"></i> {{ucfirst(strtolower($value->link_names))}}
                </a>
            @endforeach
            @if(Session::has('id'))
                <a href="{{route('dashboard')}}"> 
                    <i class="fas fa-chevron-circle-right"></i> Dashboard
                </a>
            @endif
        </div>
    </div> 
    <div class="links">
        <div class="wrapper">
            @foreach($links as $key=>$value)
                <a href="#{{strtolower($value->link_names)}}"> 
                    <i class="fas fa-chevron-circle-right"></i> {{ucfirst(strtolower($value->link_names))}}
                </a>
            @endforeach
            @if(Session::has('id'))
                <a href="{{route('dashboard')}}"> 
                    <i class="fas fa-chevron-circle-right"></i> Dashboard
                </a>
            @endif
        </div>
    </div>
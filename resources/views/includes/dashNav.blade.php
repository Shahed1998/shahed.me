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
                @php 
                    $routeName = strtolower($value->href);
                @endphp
                <a href='{{route("$routeName")}}'>   
                    <i class="fas fa-chevron-circle-right"></i> {{ucfirst(strtolower($value->href))}}
                </a>
            @endforeach
            <a href='{{route("logout")}}'>   
                    <i class="fas fa-chevron-circle-right"></i> Logout
            </a>
        </div>
    </div> 
    <div class="links">
        <div class="wrapper">
            @foreach($links as $key=>$value)
                @php 
                    $routeName = strtolower($value->href);
                @endphp
                <a href='{{route("$routeName")}}'>   
                    <i class="fas fa-chevron-circle-right"></i> {{ucfirst(strtolower($value->href))}}
                </a>
            @endforeach
            <a href='{{route("logout")}}'>   
                    <i class="fas fa-chevron-circle-right"></i> Logout
            </a>
        </div>
    </div>
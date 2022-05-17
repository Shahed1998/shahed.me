@foreach($links as $key=>$value)
    @php 
        $routeName = strtolower($value->href);
    @endphp
    <a href='{{route("$routeName")}}'>   
        <i class="fas fa-chevron-circle-right"></i> {{ucfirst(strtolower($value->href))}}
    </a>
@endforeach
<a href='{{url()->previous()}}'>   
    <i class="fa-solid fa-circle-chevron-right"></i> Go back
</a>
<a href='{{route("logout")}}'>   
    <i class="fas fa-chevron-circle-right"></i> Logout
</a>
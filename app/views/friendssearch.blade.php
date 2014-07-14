    @if (count($matches) > 0)
        @foreach($matches as $m)
            <li class="res-item cock_base">{{ $m->username }} <a href="#">Draw cock</a></li>
        @endforeach
    @endif
    @if (count($matches) > 0)
        @foreach($matches as $m)
            <li class="res-item cock_base" data-userid="{{ $m->id }}"><span>{{ $m->username }}</span></li>
        @endforeach
    @endif
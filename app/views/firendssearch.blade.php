<ul>
    @if (count($matches) > 0)
        @foreach ($matches as $m)
        <li>{{ $m->username }} <a href="#">Add friend</a></li>
        @endforeach
    @else
        <li>No result</li>
    @endif
</ul>
<ul class="result">
    @if (count($matches) > 0)

        @foreach($matches as $m)
            <li>{{ $m->username }}  Add friend</li>
        @endforeach

    @endif
</ul>
<ul>
@foreach ($matches as $m)
    <li>{{ $m->username }} <a href="#">Add friend</a></li>
@endforeach
</ul>
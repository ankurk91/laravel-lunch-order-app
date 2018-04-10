<time datetime="{{$date->toIso8601String()}}" title="{{$date->format('j M Y, g:i:s a, T')}}">
  @isset($timeAgo)
    {{$date->diffForHumans()}}
  @else
    {{$date->format($format ?? 'j M Y, g:ia')}}
  @endisset
</time>

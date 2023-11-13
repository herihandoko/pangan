<li class="{{ (request()->is($item['route'])) ? 'active' : '' }}">
    <a href="{{ url($item['href']) }}">
        @if($item['type'] == 0)
        <i class="{{ $item['icon'] }}"></i>
        @endif
        <span>{{ $item['text'] }}</span>
    </a>
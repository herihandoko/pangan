<li class="has-sub {{ (request()->is($item['route_parent'])) ? 'active' : '' }}">

    <a href="javascript:;">
        <b class="caret pull-right"></b>
        @if($item['type'] == 0)
        <i class="{{ $item['icon'] }}"></i>
        @endif
        <span>{{ $item['text'] }}</span>
    </a>

    <ul class="sub-menu">
        @each('partials.sidebar.menu-item', $item['submenu'], 'item')
    </ul>

</li>
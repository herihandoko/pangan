@inject('menuItemHelper', 'App\Helpers\MenuItemHelper')

@if ($menuItemHelper->isHeader($item))

    @include('partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

    @include('partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    @include('partials.sidebar.menu-item-treeview-menu')

@elseif ($menuItemHelper->isLink($item))

    @include('partials.sidebar.menu-item-link')

@endif

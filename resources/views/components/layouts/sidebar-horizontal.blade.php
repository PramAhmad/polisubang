<aside class="left-sidebar with-horizontal">
    <div>
        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                @foreach ($menus as $menu)
                    @if (!$menu->route && !$menu->icon)
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ $menu->name }}</span>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route($menu->route) }}" aria-expanded="false">
                                <span>
                                    <i class="{{ $menu->icon }}"></i>
                                </span>
                                <span class="hide-menu">{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
<aside class="app-sidebar bg-body-secondary shadow">
    <div class="sidebar-brand p-3">
        <a href="{{ route('user.lost-items.index') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('favicon.png') }}" alt="{{ env('APP_NAME') }}" class="brand-image opacity-75 me-2">
            <span class="fs-4 fw-light waterfall-regular">{{ env('APP_NAME') }}</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column">
                <li class="nav-item">
                    <a href="{{ route('user.lost-items.index') }}"
                       class="nav-link {{ request()->is('user/lost-items*') ? 'active' : '' }}">
                        <i class="bi bi-search nav-icon"></i>
                        <p>Lost Items</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.claims.index') ?? '#' }}"
                       class="nav-link">
                        <i class="bi bi-check-circle nav-icon"></i>
                        <p>My Claims</p>
                    </a>
                </li>

                <li class="nav-item">
    <a href="{{ route('user.temporary-ids.index') }}"
       class="nav-link {{ request()->is('user/temporary-ids*') ? 'active' : '' }}">
        <i class="bi bi-person-badge nav-icon"></i>
        <p>Temporary IDs</p>
    </a>
</li>

            </ul>
        </nav>
    </div>
</aside>

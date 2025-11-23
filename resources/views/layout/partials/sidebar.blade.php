<!--begin::Sidebar--> 
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ URL::to('/') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('favicon.png') }}"
        alt="{{ env('APP_NAME') }} Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span style="font-size:48px;" class="brand-text fw-light waterfall-regular">{{ env('APP_NAME') }}</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
      >
        {{-- Dashboard --}}
        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
        <li class="nav-item">
          <a href="{{ route('lfm.dashboard') }}" class="nav-link {{ request()->is('/') ? 'active' : "" }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif

        @if(auth()->check() && auth()->user()->isAdmin())
          {{-- User Management Section --}}
          <li class="nav-header">User Management</li>

          {{-- Roles --}}
          <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('role*') ? 'active' : "" }}">
              <i class="nav-icon bi bi-shield-lock"></i>
              <p>Roles</p>
            </a>
          </li>

          {{-- Users --}}
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : "" }}">
              <i class="nav-icon bi bi-people"></i>
              <p>Users</p>
            </a>
          </li>
        @endif

        @if(auth()->check() && (auth()->user()->isManager() || auth()->user()->isAdmin()))
          {{-- Lost and Found Manager --}}
          <li class="nav-header">Item Management</li>
          
          <li class="nav-item">
            <a href="{{ route('lfm.items.create') }}" class="nav-link {{ request()->is('lfm/items/create') ? 'active' : '' }}">
              <i class="nav-icon bi bi-plus-circle"></i>
              <p>Add Items</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('lfm.lost.create') }}" class="nav-link {{ request()->is('lfm/lost/create') ? 'active' : '' }}">
              <i class="nav-icon bi bi-search"></i>
              <p>Add Lost Item</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('lfm.claims.index') }}" class="nav-link {{ request()->is('lfm/claims*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-check-circle"></i>
              <p>Verify Claims</p>
            </a>
          </li>
        @endif

        {{-- Regular Users --}}
        @if(auth()->check() && auth()->user()->isStudent() || auth()->check() && auth()->user()->isAdmin())
          <li class="nav-header">Regular Users</li>

          <li class="nav-item">
            <a href="{{ route('user.temporary-ids.index') }}" 
               class="nav-link {{ request()->is('user/temporary-ids*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-card-text"></i>
              <p>Temporary IDs</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('user.claims.index') }}" 
                class="nav-link {{ request()->is('regular/claims*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-clipboard-check"></i>
            <p>My Claims</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('user.lost-items.index') }}" 
               class="nav-link {{ request()->is('user/lost-items*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-search"></i>
              <p>Lost Items</p>
            </a>
          </li>
        @endif

        {{--  ID Management Section --}}
        @if(auth()->user()->can('viewAny', App\Models\IdReplacement::class) || 
            in_array(auth()->user()->role->type, ['Admin', 'ID Replacement Approvers', 'Regular']))
          <li class="nav-header">ID Management</li>
          <li class="nav-item">
            <a href="{{ route('users.request-id-replacement', ['user' => auth()->id()]) }}"
               class="nav-link {{ request()->is('id-replacements*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-credit-card"></i>
              <p>ID Replacements</p>
            </a>
          </li>
        @endif

        {{-- Settings
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="{{ url::to('/') }}" class="nav-link {{ request()->is('settings*') ? 'active' : "" }}">
            <i class="nav-icon bi bi-gear"></i>
            <p>System Settings</p>
          </a>
        </li> --}}

      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

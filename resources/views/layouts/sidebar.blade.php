<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        G<span>J</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item nav-category">Inventory</li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
                <i class="link-icon" data-feather="codepen"></i>
                <span class="link-title">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('suppliers.index') }}" class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Suppliers</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sales.index') }}" class="nav-link">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">Sales</span>
            </a>
        </li>
        <li class="nav-item nav-category">Reports</li>
        <li class="nav-item">
            <a href="{{ route('reports.index') }}" class="nav-link">
                <i class="link-icon" data-feather="save"></i>
                <span class="link-title">Reporting</span>
            </a>
        </li>

        <li class="nav-item nav-category">Settings</li>
        <li class="nav-item">
            <a href="{{ route('language.index') }}" class="nav-link">
                <i class="link-icon" data-feather="globe"></i>
                <span class="link-title">Manage Languages</span>
            </a>
        </li>

        <li class="nav-item nav-category">Users</li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="link-icon" data-feather="edit"></i>
            <span class="link-title">Profile</span>
            </a>
        </li>
        @can('viewAny',\App\Models\User::class)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Manage Users</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                <ul class="nav sub-menu">
                    @can('viewAny',\App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                        </li>
                    @endcan
                    @can('viewAny',\App\Models\UserType::class)
                        <li class="nav-item">
                        <a href="{{ route('usertype.index') }}" class="nav-link">Permissions</a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
      </ul>
    </div>
</nav>

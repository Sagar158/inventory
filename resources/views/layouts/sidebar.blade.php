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
        <li class="nav-item nav-category">{{ trans('general.main') }}</li>
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">{{ trans('general.dashboard') }}</span>
          </a>
        </li>

        <li class="nav-item nav-category">{{ trans('general.inventory') }}</li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
                <i class="link-icon" data-feather="codepen"></i>
                <span class="link-title">{{ trans('general.products') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('suppliers.index') }}" class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">{{ trans('general.suppliers') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
              <i class="link-icon" data-feather="book"></i>
              <span class="link-title">{{ trans('general.categories') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sales.index') }}" class="nav-link">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">{{ trans('general.sales') }}</span>
            </a>
        </li>
        <li class="nav-item nav-category">{{ trans('general.reports') }}</li>
        <li class="nav-item">
            <a href="{{ route('reports.index') }}" class="nav-link">
                <i class="link-icon" data-feather="save"></i>
                <span class="link-title">{{ trans('general.reporting') }}</span>
            </a>
        </li>

        <li class="nav-item nav-category">{{ trans('general.users') }}</li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="link-icon" data-feather="edit"></i>
            <span class="link-title">{{ trans('general.profile') }}</span>
            </a>
        </li>
        @can('viewAny',\App\Models\User::class)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">{{ trans('general.manage_users') }}</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                <ul class="nav sub-menu">
                    @can('viewAny',\App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">{{ trans('general.users') }}</a>
                        </li>
                    @endcan
                    @can('viewAny',\App\Models\UserType::class)
                        <li class="nav-item">
                        <a href="{{ route('usertype.index') }}" class="nav-link">{{ trans('general.permissions') }}</a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
      </ul>
    </div>
</nav>

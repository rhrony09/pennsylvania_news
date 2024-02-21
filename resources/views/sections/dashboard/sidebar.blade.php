<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/backend') }}/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Onedash</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard.index') }}">
                <div class="parent-icon"><i class="bi bi-speedometer2"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">News Area</li>
        @if (in_array(auth()->user()->role->id, [1, 2, 3]))
            <li>
                <a href="{{ route('dashboard.news.index') }}">
                    <div class="parent-icon"><i class="bi bi-columns-gap"></i>
                    </div>
                    <div class="menu-title">News</div>
                </a>
            </li>
        @endif
        @if (in_array(auth()->user()->role->id, [1, 2]))
            <li>
                <a href="{{ route('dashboard.category.index') }}">
                    <div class="parent-icon"><i class="bi bi-layers"></i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
            </li>
        @endif
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-buildings"></i>
                </div>
                <div class="menu-title">Places</div>
            </a>
            <ul>
                <li><a href="{{ route('dashboard.place.resorts') }}"><i class="bi bi-circle"></i>Resorts</a></li>
                <li><a href="{{ route('dashboard.place.restaurants') }}"><i class="bi bi-circle"></i>Restaurants</a></li>
            </ul>
        </li> --}}
        @if (in_array(auth()->user()->role->id, [1, 2]))
            <li class="menu-label">Admin Area</li>
            <li>
                <a href="{{ route('dashboard.users') }}">
                    <div class="parent-icon"><i class="bi bi-people"></i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.settings.index') }}">
                    <div class="parent-icon"><i class="bi bi-gear"></i>
                    </div>
                    <div class="menu-title">Settings</div>
                </a>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</aside>

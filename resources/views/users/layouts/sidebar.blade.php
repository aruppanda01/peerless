<div class="app-sidebar sidebar-shadow">
    <!--     <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div> -->
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <div class="logo-src"><img
                    src="{{ asset('frontend/assets/images/logo-inverse.png') }}" class="img-fluid">
            </div>
            <img src="{{ asset('frontend/images/shadow.png') }}" class="img-fluid mx-auto w-100">
            <ul class="vertical-nav-menu">
                @if (Auth::user()->role_id == 2)
                    <li class="{{ Request::is('credit_user/profile') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.profile') }}">
                            <i class="fa fa-graduation-cap metismenu-icon"></i>Profile
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
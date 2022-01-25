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
            <!--<div class="logo-src"><img
                    src="{{ asset('frontend/assets/images/logo-inverse.png') }}" class="img-fluid">
            </div>
            <img src="{{ asset('frontend/images/shadow.png') }}" class="img-fluid mx-auto w-100">-->
            <ul class="vertical-nav-menu">
                @if (Auth::user()->role_id == 2)
                    {{-- <li class="{{ Request::is('credit_user/profile') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.profile') }}">
                            <i class="fa fa-graduation-cap metismenu-icon"></i>Profile
                        </a>
                    </li> --}}
                    <li class="{{ Request::is('credit_user/new-loan') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.newLoan') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>New Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('credit_user/loan*') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.loan.index') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>Submitted Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('credit_user/reverted-loan*') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.reverted-loan.index') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>Reverted Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('credit_user/change-password') ? 'mm-active' : '' }}">
                        <a href="{{ route('credit_user.changePassword') }}">
                            <i class="fa fa-cog metismenu-icon"></i>Settings
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 3)
                    {{-- <li class="{{ Request::is('operation_user/profile') ? 'mm-active' : '' }}">
                        <a href="{{ route('operation_user.profile') }}">
                            <i class="fa fa-graduation-cap metismenu-icon"></i>Profile
                        </a>
                    </li> --}}
                    <li class="{{ Request::is('operation_user/loan*') ? 'mm-active' : '' }}">
                        <a href="{{ route('operation_user.loan.index') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('operation_user/failed-loan-details*') ? 'mm-active' : '' }}">
                        <a href="{{ route('operation_user.failedLoanDetails') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>Reverted Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('operation_user/change-password') ? 'mm-active' : '' }}">
                        <a href="{{ route('operation_user.changePassword') }}">
                            <i class="fa fa-cog metismenu-icon"></i>Settings
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 4)
                    {{-- <li class="{{ Request::is('accountant_user/profile') ? 'mm-active' : '' }}">
                        <a href="{{ route('accountant_user.profile') }}">
                            <i class="fa fa-graduation-cap metismenu-icon"></i>Profile
                        </a>
                    </li> --}}
                    <li class="{{ Request::is('accountant_user/loan*') ? 'mm-active' : '' }}">
                        <a href="{{ route('accountant_user.loan.index') }}">
                            <i class="fas fa-piggy-bank metismenu-icon"></i>Loan
                        </a>
                    </li>
                    <li class="{{ Request::is('accountant_user/change-password') ? 'mm-active' : '' }}">
                        <a href="{{ route('accountant_user.changePassword') }}">
                            <i class="fa fa-cog metismenu-icon"></i>Settings
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
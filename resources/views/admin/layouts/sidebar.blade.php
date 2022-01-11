<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('admin/img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <nav class="">
        <ul class=" menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li class="{{ Request::is('admin/credit-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.credit-user.index') }}"><i class="fa  fa-user"
                        aria-hidden="true"></i>Credit Users</a></li>
            <li class="{{ Request::is('admin/operation-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.operation-user.index') }}"><i class="fa  fa-user"
                        aria-hidden="true"></i>Operation Users</a></li>
            <li class="{{ Request::is('admin/accountant-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.accountant-user.index') }}"><i class="fa  fa-user-cog"
                        aria-hidden="true"></i>Accounts Users</a></li>
            <li class="{{ Request::is('admin/loan*') ? 'active' : '' }}"><a
                    href="{{ route('admin.loan.index') }}"><i class="fa  fa-piggy-bank"
                        aria-hidden="true"></i>Loans</a></li>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i>{{ __('Logout') }}
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</div>

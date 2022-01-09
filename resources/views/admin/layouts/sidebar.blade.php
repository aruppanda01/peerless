<div class="dashboard-menubar" id="sidebar">
    <div class="image-wrapper logo-wrapper customer-logo">
        <img src="{{ asset('admin/img/logo-inverse.png') }}" class="img-fluid logo">
    </div>
    <img src="{{ asset('admin/img/shadow.png') }}" class="img-fluid mx-auto w-100">
    <nav class="">
        <ul class=" menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li class="{{ Request::is('admin/credit-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.credit-user.index') }}"><i class="fa  fa-user"
                        aria-hidden="true"></i>Credit User</a></li>
            <li class="{{ Request::is('admin/operation-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.operation-user.index') }}"><i class="fa  fa-user"
                        aria-hidden="true"></i>Operation User</a></li>
            <li class="{{ Request::is('admin/accountant-user*') ? 'active' : '' }}"><a
                    href="{{ route('admin.accountant-user.index') }}"><i class="fa  fa-user-cog"
                        aria-hidden="true"></i>Accountant User</a></li>
            <li class="{{ Request::is('admin/loan*') ? 'active' : '' }}"><a
                    href="{{ route('admin.loan.index') }}"><i class="fa  fa-piggy-bank"
                        aria-hidden="true"></i>Loan List</a></li>
                <a class="btn-pill btn-shadow btn-shine btn btn-focus mt-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>

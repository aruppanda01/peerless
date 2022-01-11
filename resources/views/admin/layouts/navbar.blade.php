<div class="col-lg-6">
    <div class="app-header-right">
        <div class="header-dots">
            <div class="dropdown">
                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                    class="p-0 mr-2 btn btn-link">
                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                        <span class="icon-wrapper-bg bg-danger"></span>
                        <i class="fa fa-bell"></i>
                        @php
                            if ($notification->unreadCount > 0) {
                                echo '<span class="badge badge-danger navbar-badge header-badge">' . $notification->unreadCount . '</span>';
                            } elseif ($notification->unreadCount > 99) {
                                echo '<span class="badge badge-danger navbar-badge header-badge">99+</span>';
                            } else {
                                echo '';
                            }
                        @endphp
                    </span>
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true"
                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                    <div class="dropdown-menu-header mb-0">
                        <div class="dropdown-menu-header-inner bg-deep-blue">
                            <div class="menu-header-image opacity-1"
                                style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                            <div class="menu-header-content text-dark">
                                <h5 class="menu-header-title">Notifications</h5>
                                @if (count($notification) > 0)
                                            You have
                                            <b>{{ $notification->unreadCount }}</b> unread
                                            {{ $notification->unreadCount == 1 ? 'notification' : 'notifications' }}
                                        @else
                                            No New Notification
                                        @endif
                            </div>
                        </div>
                    </div>
                    <div class="scroll-area-sm">
                        <div class="scrollbar-container">
                            <div class="p-3">
                                <div class="dropdown-holder">

                                    @foreach ($notification as $noti)

                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div>
                                                <span class="vertical-timeline-element-icon bounce-in">
                                                    <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                    {{-- <h4 class="timeline-title">All Hands Meeting</h4> --}}

                                    <a href="javascript:void(0)"
                                                        class=" {{ $noti->read_flag == 0 ? 'unread' : 'read' }}"
                                                        onclick="readNotification('{{ $noti->id }}', '{{ $noti->route ? route($noti->route) : '' }}')">
                                                        <p>{{ $noti->title }}
                                                            <span class="font-weight-bold">{{ getAsiaTime($noti->created_at) }}</span>
                                                        </p>
                                                    </a>

                                                    <span class="vertical-timeline-element-date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-content">
                        <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container ps">
                                    <div class="p-3">
                                        <div class="notifications-box">
                                            <div
                                                class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                <div
                                                    class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Yet another one, at <span class="text-success">15:00
                                                                    PM</span></p>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-success vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Build the production release
                                                                <span class="badge badge-danger ml-2">NEW</span>
                                                            </h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Something not important
                                                                <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/1.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/2.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/3.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/4.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/5.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/9.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/7.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                        <div class="avatar-icon">
                                                                            <img src="assets/images/avatars/8.jpg"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                        <div class="avatar-icon"><i>+</i></div>
                                                                    </div>
                                                                </div>
                                                            </h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">This dot has an info state</h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Yet another one, at <span class="text-success">15:00
                                                                    PM</span>
                                                            </p><span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="vertical-timeline-item dot-success vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Build the production release
                                                                <span class="badge badge-danger ml-2">NEW</span>
                                                            </h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">This dot has a dark state</h4>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-events-header" role="tabpanel">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container ps">
                                    <div class="p-3">
                                        <div
                                            class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at
                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00
                                                                PM</b></p>
                                                        <p>Yet another one, at <span class="text-success">15:00
                                                                PM</span></p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                            incididunt ut
                                                            labore et dolore magna elit enim at minim veniam quis
                                                            nostrud
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-primary"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important
                                                        </h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim
                                                            veniam quis nostrud</p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at
                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00
                                                                PM</b></p>
                                                        <p>Yet another one, at <span class="text-success">15:00
                                                                PM</span></p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                            incididunt ut
                                                            labore et dolore magna elit enim at minim veniam quis
                                                            nostrud
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-primary"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important
                                                        </h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim
                                                            veniam quis nostrud</p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container ps">
                                    <div class="no-results pt-3 pb-0">
                                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                            <div class="swal2-success-circular-line-left"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                            <span class="swal2-success-line-tip"></span>
                                            <span class="swal2-success-line-long"></span>
                                            <div class="swal2-success-ring"></div>
                                            <div class="swal2-success-fix"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                            <div class="swal2-success-circular-line-right"
                                                style="background-color: rgb(255, 255, 255);"></div>
                                        </div>
                                        <div class="results-subtitle">All caught up!</div>
                                        <div class="results-title">There are no system errors!</div>
                                    </div>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item-divider nav-item"></li>
                        <li class="nav-item-btn text-center nav-item">
                            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest
                                Changes</button>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>

        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left header-user-info">
                        <div class="widget-heading"> {{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</div>
                        <div class="widget-subheading">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    <div class="widget-content-left ml-3">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="p-0 btn">
                                {{-- <img width="42" class="rounded-circle"
                                    src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}"
                                    alt=""> --}}
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2"
                                            style="background-image: url('{{ asset('frontend/assets/images/dropdown-header/city3.jpg') }}');">
                                        </div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper justify-content-between p-2">
                                                    {{-- <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                            src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}"
                                                            alt="">
                                                    </div> --}}
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading text-white">
                                                            {{ Auth::user()->first_name }}
                                                            {{ Auth::user()->last_name }}</div>
                                                        {{-- <div class="widget-subheading">{{ Auth::user()->email }}</div> --}}
                                                    </div>
                                                    <div class="widget-content-right mr-2">

                                                        <a class="btn-pill btn-shadow btn-shine btn btn-focus"
                                                            href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="scroll-area-xs" style="height: auto">
                                    <div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Email:</b>{{ Auth::user()->email }} </p>
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Department:</b>{{ Auth::user()->role['name'] }}</p>
                                                <p class="nav-link mb-0 pb-0"><b class="mr-2">Id:</b>{{ Auth::user()->id_no }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

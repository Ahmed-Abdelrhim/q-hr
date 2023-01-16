@php
use App\Models\Utility;
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$languages = Utility::languages();
// $profile = asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar/');

$mode_setting = \App\Models\Utility::mode_layout();
@endphp
<header
    class="dash-header  {{ isset($mode_setting['is_sidebar_transperent']) && $mode_setting['is_sidebar_transperent'] == 'on' ? 'transprent-bg' : '' }}">
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="theme-avtar">
                            <img alt="#"
                                src="{{ !empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png' }}"
                                class="header-avtar" style="width: 100%">
                        </span>
                        <span class="hide-mob ms-2"> {{ Auth::user()->name }}
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('My Profile') }}</span>
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf</form>
                    </div>
                </li>


            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">

                @php
                    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
                        ->where('seen', 0)
                        ->count();
                @endphp

                @if (Auth::user()->type != 'super admin')
                    <li class="dash-h-item">
                        <a class="dash-head-link me-0" href="{{ url('/chats') }}">
                            <i class="ti ti-message-circle"></i>
                            <span
                                class="bg-danger dash-h-badge message-counter custom_messanger_counter">{{ $unseenCounter }}<span
                                    class="sr-only"></span>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->type != 'super admin')
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-message-2"></i>
                            <span class="bg-danger dash-h-badge message-toggle-msg"><span class="sr-only"></span>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                            <div class="noti-header">
                                <h5 class="m-0">{{ __('Messages') }}</h5>
                                <a href="#"
                                    class="dash-head-link mark_all_as_read_message">{{ __('Clear All') }}</a>
                                {{-- @php
                                    $notifications = \Auth::user()->notifications();
                                @endphp
                                @foreach ($notifications as $notification)
                                    {!! $notification->toHtml() !!}
                                @endforeach --}}
                            </div>
                            <div class="noti-body dropdown-list-message-msg">
                            </div>
                            <div class="noti-footer">
                                <div class="d-grid">
                                    <a href="{{ route('chats') }}"
                                        class="btn dash-head-link justify-content-center text-primary mx-0">View all</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                {{-- @if (\Auth::user()->type != 'super admin')
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-bell"></i>
                            <span class="bg-danger dash-h-badge notification-toggle"><span
                                    class="sr-only"></span></span>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end notification-dropdown">
                            <div class="noti-header">
                                <h5 class="m-0">{{ __('Notifications') }}</h5>
                                <a href="#" class="dash-head-link mark_all_as_read">{{ __('Clear All') }}</a>
                            </div>
                            <div class="noti-body" id="notification-list">
                                @php
                                    $notifications = \Auth::user()->notifications();
                                @endphp
                                @foreach ($notifications as $notification)
                                    {!! $notification->toHtml() !!}
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif --}}
                @php
                 $currantLang = basename(\App::getLocale())
              @endphp
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob">{{ Str::upper($currantLang) }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" aria-labelledby="dropdownLanguage">
                        @foreach (App\Models\Utility::languages() as $lang)
                            <a href="{{ route('change.language', $lang) }}"
                                class="dropdown-item {{ basename(App::getLocale()) == $lang ? 'text-danger' : '' }}">{{ Str::upper($lang) }}</a>
                        @endforeach
                        {{-- @if (\Auth::user()->type == 'super admin')
                            <div class="dropdown-divider m-0"></div>
                            <a href="{{ route('manage.language', [basename(App::getLocale())]) }}"
                                class="dropdown-item text-primary">{{ __('Manage Language') }}</a>
                        @endif --}}
                        <div class="dropdown-divider m-0"></div>
                        @can('Create Language')
                            <a class="dropdown-item text-primary"
                                href="{{ route('manage.language', [$currantLang]) }}">{{ __('Manage Language') }}</a>
                        @endcan
                    </div>
                </li>

            </ul>
        </div>
    </div>
</header>

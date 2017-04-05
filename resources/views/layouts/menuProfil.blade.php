<li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="{{ asset('karmanta/img/avatar1_small.jpg') }}">
                            </span>
        <span class="username">
                            @if(\Illuminate\Support\Facades\Auth::check())
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
            @endif
                        </span>
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu extended logout">
        <div class="log-arrow-up"></div>
        <li class="eborder-top">
            <a href="#"><i class="icon_profile"></i> My Profile</a>
        </li>
        <li>
            <a href="{{ route('logout') }}" id="logout-link"><i class="icon_key_alt"></i> Log Out</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
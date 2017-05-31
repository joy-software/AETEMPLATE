<li class="dropdown dropdown active">

    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

        <span class="profile-ava" >
            <img alt="Photo" src="{{ url('/cache/logo/'. Auth::user()->photo) }}" >
        </span>

        <span class="username">
            @if(\Illuminate\Support\Facades\Auth::check())
                {{ \Illuminate\Support\Facades\Auth::user()->surname }}
            @endif
        </span>

        <b class="caret"></b>
    </a>

    <ul class="dropdown-menu extended logout">

        <div class="log-arrow-up"></div>
        <li class="eborder-top">
            <a href=" {{ route('profile') }}"><i class="icon_profile"></i> My Profile</a>
        </li>

        <li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="icon_key_alt"></i> Log Out
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

    </ul>
</li>
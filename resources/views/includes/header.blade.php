<header class="fixed">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div id="logo_home">
                    <h1><a href="{{ url('/') }}" title="Navigator Tourism">Navigator Tourism</a></h1>
                </div>
            </div>
            <nav class="col-9">
                @if(\Illuminate\Support\Facades\Session::get('user'))
                    <div class="dropdown" id="top_tools">
                        <a class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> {{ decrypt(session('user'))->display_name }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="padding: 10px; width: 200px">
                            <li class="mt-2"><a href="{{ route('profile.index') }}"><i class="icon-user"></i> Profile</a></li>
                            <li class="mt-2"><a href="{{ route('profile.history') }}"><i class="icon-list"></i> Booking History</a></li>
                            <li class="mt-2"><a href="{{ route('visa.index') }}"><i class="icon-vcard"></i> Visa Information</a></li>
                            <li class="mt-2"><a href="{{ route('logout.index') }}"><i class="icon-logout"></i> Logout</a></li>
                        </ul>
                    </div>
                @else
                    <ul id="top_tools">
                        <li><a href="{{ route('visa.index') }}"><i class="icon-vcard"></i> Visa Information</a></li>
                        <li><a href="{{ route('login.index') }}"><i class="icon-key"></i> Login</a></li>
                        <li><a href="{{ route('sign-up.index') }}"><i class="icon-user"></i> Signup</a></li>
                    </ul>
                @endif
            </nav>
        </div>
    </div><!-- container -->
</header><!-- End Header -->

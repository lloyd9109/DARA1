<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DARA Main Page</title>
    @vite(['resources/css/guest/main.css', 'resources/js/guest/main.js'])
</head>
<body>

    <header>
        <div class="header-left">
            <img src="{{ asset('storage/images/DARA.png') }}" alt="DARA Logo">
            <h2>D A R A</h2>
        </div>

        {{-- ✅ Show only if NOT logged in --}}
        @guest
            <a class="loginbutton" href="{{ url('/auth/login') }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-log-in">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                <h4>&nbsp; Login</h4>
            </a>
        @endguest

        {{-- ✅ Show only if logged in --}}
        @auth
            <div class="user-menu">
                <span>👋 {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} DARA - Digital Academic Repository and Archive</p>
    </footer>

</body>
</html>

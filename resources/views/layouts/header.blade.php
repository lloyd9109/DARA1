<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DARA Main Page</title>
    @vite(['resources/css/guest/main.css', 'resources/js/guest/main.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <div class="header-left">
        <img src="{{ asset('storage/images/DARA.png') }}" alt="DARA Logo">
        <h2>D A R A</h2>
    </div>

    <!-- Hamburger for mobile -->
    <button class="hamburger" id="hamburger">
        <i class="fa-solid fa-bars"></i>
    </button>

    <nav class="header-nav" id="headerNav">
        @guest
            <a class="loginbutton" href="{{ url('/auth/login') }}">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Login</span>
            </a>
        @endguest

        @auth
            <div class="user-dropdown">
                <button class="user-toggle">
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <ul class="user-menu">
                    <li>
                        <a href="{{ url('/profile') }}">
                            <i class="fa-solid fa-user-graduate"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/settings') }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} DARA - Digital Academic Repository and Archive</p>
</footer>

<script>
    // Mobile toggle
    document.getElementById("hamburger").addEventListener("click", function () {
        document.getElementById("headerNav").classList.toggle("active");
    });
</script>

</body>
</html>

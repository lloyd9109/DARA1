<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/guest/login.css', 'resources/js/guest/login.js'])
</head>
<body>
    
    <header class="topbar">
        <div class="logo">D A R A</div>

        <div class="title-search">
            <form id="searchForm" action="/results" method="GET" class="search">
                @csrf
                <input 
                    id="srch" 
                    name="search" 
                    type="text" 
                    placeholder="Search..." 
                    value="{{ old('search', request()->input('search')) }}"
                >
                <button type="submit">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="18" height="18" 
                        fill="none" stroke="#0c1c43" stroke-width="2" 
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </button>
            </form>

        </div>

        <nav class="nav-links">
            <a href="/">Home</a>
        </nav>
    </header>
    <div class="page-layout">
        <aside class="sidebar">
            <div class="year-filter">
                <input type="number" id="from-year" name="from-year" placeholder="From year">
                <span>-</span>
                <input type="number" id="to-year" name="to-year" placeholder="to year">
            </div>

            <p class="ataya-gud">Looking for?</p>
            <div class="doc-types">
                <button>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="icon" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 17A2.5 2.5 0 0 0 4 14.5V5a2 2 0 0 1 2-2h14v14H6.5z"/></svg>
                    Case Study
                </button>
                <button>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="icon" viewBox="0 0 24 24"><path d="M22 9L12 2 2 9l10 7 10-7z"/><path d="M2 9v6c0 3 4 5 10 5s10-2 10-5V9"/></svg>
                    Thesis
                </button>
                <button>
                
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="icon" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M12 4H3v16h9V4z"/><path d="M16 2v4h4"/></svg>
                    Proposal
                </button>
                <button>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="icon" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><path d="M8 21h8m-4-4v4"/></svg>
                    Capstone
                </button>
                <button>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06c.46-.46.59-1.15.33-1.82A1.65 1.65 0 0 0 3 12.09V12a2 2 0 0 1 0-4v.09c0 .66.26 1.3.73 1.77.46.46 1.15.59 1.82.33A1.65 1.65 0 0 0 7.91 9H8a2 2 0 0 1 4 0h.09c.66 0 1.3.26 1.77.73.46.46.59 1.15.33 1.82a1.65 1.65 0 0 0 .33 1.82c.47.46 1.15.59 1.82.33a1.65 1.65 0 0 0 1.77-.73V12a2 2 0 0 1 4 0v.09c0 .66-.26 1.3-.73 1.77z"/></svg>
                    System Studies
                </button>
            </div>
        </aside>
            @yield('content')

    </div>
</body>
</html>
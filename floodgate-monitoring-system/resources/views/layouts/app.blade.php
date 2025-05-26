<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Smart Flood Management')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4ff; /* Light blue-ish background */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #e6e6fa; /* Lavender */
            padding: 20px 0;
            text-align: center;
        }
        header img.logo { /* Added class for logo image */
            display: block;
            margin: 0 auto 10px auto; /* Center logo and add space below */
        }
        header .system-name {
            margin: 0;
            font-size: 1.5em;
            font-weight: bold;
        }
        nav {
            margin-top: 10px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }
        nav ul li:last-child {
            margin-right: 0;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        main {
            flex-grow: 1; /* Allows main content to expand */
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #ddeeff; /* Light blue */
            margin-top: auto; /* Pushes footer to the bottom */
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <img src="https://via.placeholder.com/150x50?text=Logo" alt="System Logo" width="150" class="logo">
            <p class="system-name">Smart Flood Management Systems 2025</p>
            <nav>
                <ul>
                    <li><a href="#search-section">Search</a></li>
                    <li><a href="#dashboard-section">Statistics Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>Developed by :: Korn</p>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetElement = document.querySelector(this.getAttribute('href'));
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

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
        /* Global Reset & Base Styles */
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Prompt', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4ff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            line-height: 1.6;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        header {
            background-color: #e6e6fa;
            padding: 20px 0;
            text-align: center;
        }
        header .logo {
            display: block;
            margin: 0 auto 10px auto;
        }
        header .system-name {
            margin: 0 0 15px 0;
            font-size: 1.8em;
            font-weight: bold;
        }

        /* Navigation Styles */
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover,
        nav ul li a:focus {
            background-color: rgba(0,0,0,0.1);
        }

        /* Main Content Styles */
        main {
            flex-grow: 1;
        }
        
        /* Table Responsiveness */
        .table-responsive-container {
            overflow-x: auto; /* Allows table to scroll horizontally */
            width: 100%;    /* Ensures container takes full width before scrolling */
            margin-bottom: 1rem; /* Optional: adds some space below the table container */
        }
        .table-responsive-container table { /* Ensure table itself doesn't try to shrink its content too much */
            min-width: 600px; /* Example: force a minimum width if content is very narrow */
        }


        /* Footer Styles */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #ddeeff;
            margin-top: auto;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            header .system-name {
                font-size: 1.5em;
            }
            nav ul li {
                display: block;
                margin: 10px 0;
            }
            nav ul li a {
                display: block;
            }

            /* Search form adjustments */
            #search-section form div { /* The flex container for label, input, button */
                flex-direction: column; /* Stack elements */
                align-items: stretch; /* Make elements take full width */
            }
            #search-section form label {
                margin-bottom: 5px;
                flex-basis: auto; /* Reset flex-basis */
            }
            #search-section form input[type="text"],
            #search-section form button {
                width: 100%; /* Make input and button full width */
                box-sizing: border-box; /* Include padding and border in element's total width and height */
            }
            #search-section form button {
                margin-top: 10px; /* Add space above button when stacked */
            }
            
            /* Dashboard card layout adjustments */
            .dashboard-cards-container { /* The flex wrapper for cards */
                flex-direction: column !important; /* Stack cards vertically, !important if overriding inline */
                align-items: center !important; /* Center cards */
            }
            .dashboard-card { /* Individual cards */
                flex-basis: 90% !important; /* Allow cards to take more width when stacked, !important if overriding inline */
                width: 90% !important; /* Ensure width is also set */
                margin-bottom: 15px !important; /* Add space between stacked cards */
            }
        }
        @media (max-width: 480px) {
            header .system-name {
                font-size: 1.2em;
            }
            .container {
                padding: 10px; /* Reduce padding on very small screens */
            }
            section { /* Reduce padding for all sections */
                padding: 20px 10px !important; /* Override inline styles if necessary */
            }
            h2 {
                font-size: 1.2em; /* Reduce heading sizes */
            }
            .dashboard-card { /* Further adjust cards for very small screens */
                flex-basis: 95% !important;
                width: 95% !important;
            }
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

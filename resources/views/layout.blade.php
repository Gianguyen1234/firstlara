<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Post')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- {{-- CKEditor CDN --}} -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <!-- Custom CSS for Navbar -->
    <style>
        /* Navbar */
        .navbar {
            background-color: #343a40;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.7rem;
            font-weight: bold;
            color: #ffffff;
        }

        .nav-link {
            color: #ffffff;
            margin-right: 15px;
        }

        .nav-link:hover {
            color: #d4d4d4;
            border-bottom: 2px solid #ffffff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- Blog Brand/Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">MyBlog</a>

        <!-- Navbar Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/posts') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>

                <!-- Dropdown Menu for Categories -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Tech</a>
                        <a class="dropdown-item" href="#">Lifestyle</a>
                        <a class="dropdown-item" href="#">Travel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Other</a>
                    </div>
                </li>
            </ul>

            <!-- Search Form -->
            <form class="search-form my-2 my-lg-0">
                <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                <button type="submit">
                    <i class='bx bx-search'></i>
                </button>
            </form>

            <!-- Authentication Links -->
            @guest
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
            @else
            <!-- Link to Profile Edit -->
            <a href="{{ route('profile.edit') }}" class="btn btn-login">{{ Auth::user()->name }}</a>
            <!-- link for usertype -->
            @if(Auth::user()->usertype == 'admin')
            <!-- Link to Admin Dashboard for Admin Users -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-admin">Admin Dashboard</a>
            @else
            <!-- Link for Regular Users (optional, if needed) -->
            <a href="{{ url('/') }}" class="btn btn-dashboard">Default User</a>
            @endif


            <!-- Logout Button -->
            <a href="{{ route('logout') }}" class="btn btn-signup"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest


        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Include Footer Partial -->
    @include('partials.footer')

    <!--  Bootstrap's JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{route('ckeditor.upload',['_token'=>csrf_token()])}}"
                },
                toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'ckfinder', 'imageUpload', '|', 'undo', 'redo'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</body>

</html>
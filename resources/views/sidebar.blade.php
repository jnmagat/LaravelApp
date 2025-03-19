<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Exam - Rotary</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Navbar for mobile --}}
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
                <i class="bi bi-list"></i> Menu
            </button>
        </div>
    </nav>

    <div class="d-flex">
        @if(session()->has('user_id'))
        
        {{-- Sidebar (Offcanvas for mobile, Fixed for desktop) --}}
        <div class="sidebar bg-dark text-white p-3 vh-100 d-none d-md-flex flex-column">
            <h4 class="mb-3">
                <a class="nav-link text-white" href="{{route('dashboard')}}">Dashboard</a>
            </h4>
            <hr>
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('employee')}}">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('department')}}">Departments</a>
                </li>
            </ul>
            <hr>
            <ul class="nav flex-column mt-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Mobile Sidebar (Offcanvas) --}}
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('employee')}}">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('department')}}">Departments</a>
                    </li>
                </ul>
                <hr>
                <ul class="nav flex-column mt-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @endif

        {{-- Main Content --}}
        <div class="main-content flex-grow-1 p-4">
            @yield('content')
        </div>
        
        {{-- Toast --}}
        <!-- Toast Container (Keep this inside your sidebar so it's always available) -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="tableToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body" id="toastMessage">
                        Action successful!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>


        
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Exam - Rotary</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        @if(session()->has('user_id'))
        {{-- sidebar --}}
        <div class="sidebar d-flex flex-column bg-dark text-white p-3 vh-100">
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
        @endif
        {{-- main content --}}
        <div class="main-content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>

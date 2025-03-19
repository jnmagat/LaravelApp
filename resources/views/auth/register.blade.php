@extends('sidebar')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 400px;">
        <h1 class="text-dark pb-3 text-center">Registration</h1>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Registration Form --}}
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="username">Username:</label>
                <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Email:</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password Field with Eye Icon --}}
            <div class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password Field with Eye Icon --}}
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirm Password:</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="pt-3 d-grid">
                <button class="btn btn-success" type="submit">Register</button>
            </div>
        </form>

        <p class="mt-3 text-center">
            Already have an account? <a href="{{ route('login.form') }}">Login here</a>
        </p>
    </div>
</div>


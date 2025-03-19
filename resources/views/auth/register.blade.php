@extends('sidebar')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-5 w-25">
        <h1 class="text-dark pb-3">Registration</h1>
        {{-- error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- form --}}
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
                <label class="form-label" for="name">Name:</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
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

            <div class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirm Password:</label>
                <input class="form-control" type="password" name="password_confirmation" required>
            </div>

            <div class="pt-3">
                <button class="btn btn-success" type="submit">Register</button>
            </div>
        </form>

        <p class="mt-3 text-center">
            Already have an account? <a href="{{ route('login.form') }}">Login here</a>
        </p>
    </div>
</div>
@endsection

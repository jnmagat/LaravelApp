    @extends('sidebar')

    @section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-5">
            <h1 class="text-dark pb-3">Login</h1>
            {{-- form --}}
            <form action="{{ route('login')}}" method="post">
                @csrf
                {{-- error --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                {{-- Success Message --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="">
                    <label class="form-label" for="">Username: </label>
                    <input class="form-control" type="text" name="username" required>
                </div>
                <div class="mt-3">
                    <label class="form-label" for="">Password: </label>
                    <div class="input-group">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="pt-3">
                    <button class="btn btn-success w-100" type="submit">Login</button>
                </div>
            </form>
            <p class="mt-3 text-center">
                Don't have an account? <a href="{{ route('register.form') }}">Register here</a>
            </p>
        </div>
    </div>
    @endsection

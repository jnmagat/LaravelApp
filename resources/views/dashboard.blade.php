@extends('sidebar')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark fw-bold mb-4">Dashboard</h2>
    <hr>
    <br>
    <div class="row">
        {{-- card for emp --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm bg-success">
                <div class="card-body text-center ">
                    <h5 class="card-title text-white">Total Employees</h5>
                    <h3 class="fw-bold text-primary text-white">{{ $totalEmployees }}</h3>
                    <a href="{{ route('employee') }}" class="btn btn-outline-light btn-sm mt-3">View Employees</a>
                </div>
            </div>
        </div>
        {{-- card for dept --}}
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm bg-warning">
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">Total Departments</h5>
                    <h3 class="fw-bold text-dark ">{{ $totalDepartments }}</h3>
                    <a href="{{ route('department') }}" class="btn btn-outline-dark btn-sm mt-3">View Departments</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

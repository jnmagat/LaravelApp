@extends('sidebar')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold m-0 text-success">Manage Departments</h2>
        {{-- Modal btn --}}
        <button type="button" id="addDepartmentBtn" class="btn btn-success">
            Add Department
        </button>
    </div>

     <div id="departmentContainer">
        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="departmentTableBody">
                    @foreach($departments as $department)
                    <tr id="row-{{ $department->id }}">
                        <td>{{ $department->id }}</td>
                        <td class="dept-name">{{ $department->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $department->id }}" data-name="{{ $department->name }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $department->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    
    {{-- Create or Edit Modal --}}
<div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departmentModalLabel">Create Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- errors --}}
                <div id="departmentError" class="alert alert-danger d-none"></div>

                <form id="departmentForm">
                    @csrf
                    <input type="hidden" id="department_id">
                    {{-- department name --}}
                    <div class="mb-3">
                        <label class="form-label" for="department_name">Name:</label>
                        <input class="form-control" type="text" id="department_name" maxlength="40" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save Department</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection

@vite(['resources/js/manage/department.js'])

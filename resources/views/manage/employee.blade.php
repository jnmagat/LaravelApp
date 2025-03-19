@extends('sidebar')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold m-0 text-success">Manage Employees</h2>
        <!-- Modal Btn -->
        <button type="button" id="addEmployeeBtn" class="btn btn-success">
            Add Employee
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                @foreach($employees as $employee)
                <tr id="row-{{ $employee->id }}">
                    <td>{{ $employee->id }}</td>
                    <td class="emp-name">{{ $employee->name }}</td>
                    <td class="emp-email">{{ $employee->email }}</td>
                    <td class="emp-dept">{{ $employee->department_name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                            data-id="{{ $employee->id }}" 
                            data-name="{{ $employee->name }}" 
                            data-email="{{ $employee->email }}" 
                            data-department-id="{{ $employee->department_id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $employee->id }}">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   {{-- Create or Edit Modal --}}
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="employeeModalLabel">Create Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- errors --}}
                <div id="employeeError" class="alert alert-danger d-none"></div>

                <form id="employeeForm">
                    @csrf
                    <input type="hidden" id="employee_id">

                    <div class="row">
                        {{-- emp_name --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="employee_name">Name:</label>
                                <input class="form-control" type="text" id="employee_name" maxlength="100" required>
                            </div>
                        </div>

                        {{-- emp_email --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="employee_email">Email:</label>
                                <input class="form-control" type="email" id="employee_email" required>
                            </div>
                        </div>

                        {{-- dept --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="department_id">Department:</label>
                                <select class="form-select" id="department_id" required>
                                    <option value="" disabled selected>Select a department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Employee</button>
                </div>
                </form>
        </div>
    </div>
</div>


</div>
@endsection

@vite(['resources/js/manage/employee.js'])

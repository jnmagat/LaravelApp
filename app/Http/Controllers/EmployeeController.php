<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    public function index() {
        $employees = \DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.name', 'employees.email', 'departments.name as department_name', 'employees.department_id')
            ->get();
            
        $departments = Department::select('id', 'name')->get();

        return view('manage.employee', compact('employees', 'departments')); 
    }
    
    public function store(Request $request) {
        try {
            // Validate data for creating a new employee
            $request->validate([
                'employee_name' => 'required|string|max:100',
                'employee_email' => 'required|email|unique:employees,email', // Ensure unique email for new employees
                'department_id' => 'required|exists:departments,id',
            ]);
        
            // Create employee
            $employee = Employee::create([
                'name' => $request->employee_name,
                'email' => $request->employee_email,
                'department_id' => $request->department_id
            ]);
        
            // Reload the employee with department relationship
            $employee->load('department');
        
            return response()->json([
                'success' => true,
                'employee' => $employee,
                'department_name' => $employee->department ? $employee->department->name : 'N/A' 
            ]);
        
        } catch (ValidationException $e) {
            // Validation error occurred (like unique constraint violation)
            return response()->json(['error' => 'Validation failed.', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error occurred while creating employee: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong, please try again later.'], 500);
        }
    }
    
    public function update(Request $request, $id) {
        try {
            $employee = Employee::findOrFail($id);
    
            $request->validate([
                'employee_name' => 'required|string|max:100',
                'employee_email' => 'required|email|unique:employees,email,' . $id, 
                'department_id' => 'required|exists:departments,id',
            ]);
    
            $employee->update([
                'name' => $request->employee_name,
                'email' => $request->employee_email,
                'department_id' => $request->department_id
            ]);
    
            return response()->json([
                'success' => true,
                'department_name' => $employee->department->name
            ]);
    
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    

    public function destroy($id) {
        Employee::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}

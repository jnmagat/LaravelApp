<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request) {
        $employees = \DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.name', 'employees.email', 'departments.name as department_name', 'employees.department_id')
            ->get();
            
        $departments = Department::select('id', 'name')->get();

        return view('manage.employee', compact('employees', 'departments')); 
    }
    
    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'employee_name'  => 'required|string|max:100',
                'employee_email' => 'required|email|unique:employees,email',
                'department_id'  => 'required|exists:departments,id',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors()
                ], 422);
            }
    
            $employee = Employee::create([
                'name'          => $request->employee_name,
                'email'         => $request->employee_email,
                'department_id' => $request->department_id
            ]);
            
            $employee->load('department');
    
            return response()->json([
                'success'  => true,
                'message'  => 'Employee successfully created!',
                'employee' => $employee,
                'department_name' => $employee->department->name ?? 'N/A'
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error creating employee:', ['message' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please try again later.'
            ], 500);
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
    
            // Reload with department name
            $employee->load('department');
    
            return response()->json([
                'success' => true,
                'employee' => $employee,
                'message'  => 'Employee successfully edited!',
                'department_name' => $employee->department->name ?? 'N/A'
            ]);
    
        } catch (\Exception $e) {
            return response()->json(['errors' => ['message' => 'An error occurred.']], 500);
        }
    }
    
    

    public function destroy($id) {
        Employee::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message'  => 'Employee successfully deleted!',
        ]);
    }
}

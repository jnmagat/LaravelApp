<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    public function index() {
       
        $departments = \DB::table('departments')->select('id', 'name')->get();
        return view('manage.department', compact('departments')); 
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                'department_name' => 'required|string|max:40|unique:departments,name',
            ]);

            $department = Department::create([
                'name' => $request->department_name
            ]);

            return response()->json(['success' => true, 'department' => $department]);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'department_name' => 'required|string|max:40|unique:departments,name,' . $id,
            ]);

            $department = Department::findOrFail($id);
            $department->update(['name' => $request->department_name]);

            return response()->json(['success' => true]);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id) {
        // Find the department by ID
        $department = Department::findOrFail($id);
    
        // Check if there are any employees assigned to this department
        $employeeCount = Employee::where('department_id', $department->id)->count();
    
        if ($employeeCount > 0) {
            // If there are employees, return an error message
            return response()->json(['error' => 'This department has active employees and cannot be deleted.'], 400); // 400 Bad Request
        }
    
        // Delete the department
        $department->delete();
    
        // Return a success response
        return response()->json(['success' => true]);
    }
    
}

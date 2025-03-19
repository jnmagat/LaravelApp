<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();

        $recentEmployees = Employee::join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.name', 'employees.email', 'departments.name as department_name')
            ->orderBy('employees.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('totalEmployees', 'totalDepartments'));
    }
}

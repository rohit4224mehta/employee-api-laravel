<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // GET /api/employees - List all employees
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'message' => 'List of employees',
            'data' => $employees
        ]);
    }

    // POST /api/employees - Create new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0'
        ]);

        $employee = Employee::create($request->all());

        return response()->json([
            'message' => 'Employee added successfully',
            'data' => $employee
        ], 201);
    }

    // GET /api/employees/{id} - Get single employee
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json([
            'message' => 'Employee details',
            'data' => $employee
        ]);
    }

    // PUT /api/employees/{id} - Update employee
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'position' => 'sometimes|required|string|max:100',
            'salary' => 'sometimes|required|numeric|min:0'
        ]);

        $employee->update($request->all());

        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    // DELETE /api/employees/{id} - Delete employee
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}

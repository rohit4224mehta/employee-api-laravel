<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;

class WebEmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::paginate(10);
            return view('employees', compact('employees'));
        } catch (Exception $e) {
            Session::flash('error', '❌ Server error: ' . $e->getMessage());
            return view('employees', ['employees' => []]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'position' => 'required|string|max:100',
                'salary' => 'required|numeric|min:0'
            ]);

            Employee::create($validated);

            return redirect()
                ->route('employees.index')
                ->with('success', '✅ Employee added successfully!');
        } catch (ValidationException $e) {
            return redirect()
                ->route('employees.index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->with('error', '❌ Failed to add employee: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('employees_edit', compact('employee'));
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->with('error', '⚠️ Employee not found or server error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,' . $id,
                'position' => 'required|string|max:100',
                'salary' => 'required|numeric|min:0'
            ]);

            $employee->update($validated);

            return redirect()
                ->route('employees.index')
                ->with('success', '✅ Employee updated successfully!');
        } catch (ValidationException $e) {
            return redirect()
                ->route('employees.edit', $id)
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            return redirect()
                ->route('employees.edit', $id)
                ->with('error', '❌ Failed to update employee: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()
                ->route('employees.index')
                ->with('success', '🗑️ Employee deleted successfully!');
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->with('error', '⚠️ Failed to delete employee: ' . $e->getMessage());
        }
    }
}

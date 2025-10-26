<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class EmployeeController extends Controller
{
    /**
     * GET /api/employees - List all employees with pagination and filtering
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $query = Employee::query();

            // Apply filtering by position if provided
            if ($request->has('position')) {
                $query->where('position', 'like', '%' . $request->input('position') . '%');
            }

            // Paginate results (10 employees per page)
            $employees = $query->paginate(10);

            return response()->json([
                'status' => 'success',
                'message' => 'List of employees retrieved successfully',
                'data' => $employees->items(),
                'pagination' => [
                    'current_page' => $employees->currentPage(),
                    'total_pages' => $employees->lastPage(),
                    'total_items' => $employees->total(),
                    'per_page' => $employees->perPage(),
                    'next_page_url' => $employees->nextPageUrl(),
                    'prev_page_url' => $employees->previousPageUrl()
                ],
                'timestamp' => now()->toDateTimeString()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve employees',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }

    /**
     * POST /api/employees - Create a new employee
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'position' => 'required|string|max:100',
                'salary' => 'required|numeric|min:0'
            ]);

            $employee = Employee::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully',
                'data' => $employee,
                'timestamp' => now()->toDateTimeString()
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'timestamp' => now()->toDateTimeString()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create employee',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }

    /**
     * GET /api/employees/{id} - Get a single employee
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee retrieved successfully',
                'data' => $employee,
                'timestamp' => now()->toDateTimeString()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
                'error' => 'No employee found with ID: ' . $id,
                'timestamp' => now()->toDateTimeString()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve employee',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }

    /**
     * PUT /api/employees/{id} - Update an employee
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:employees,email,' . $id,
                'position' => 'sometimes|required|string|max:100',
                'salary' => 'sometimes|required|numeric|min:0'
            ]);

            $employee->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee updated successfully',
                'data' => $employee,
                'timestamp' => now()->toDateTimeString()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
                'error' => 'No employee found with ID: ' . $id,
                'timestamp' => now()->toDateTimeString()
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'timestamp' => now()->toDateTimeString()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update employee',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }

    /**
     * DELETE /api/employees/{id} - Delete an employee
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully',
                'data' => null,
                'timestamp' => now()->toDateTimeString()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
                'error' => 'No employee found with ID: ' . $id,
                'timestamp' => now()->toDateTimeString()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete employee',
                'error' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString()
            ], 500);
        }
    }
}
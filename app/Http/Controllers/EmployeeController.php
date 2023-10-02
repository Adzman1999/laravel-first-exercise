<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // Show all Employee
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::latest()->paginate(10)
        ]);
    }

    //Show single Employee
    public function show(Employee $employee)
    {
        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    // Show Create Form
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    // Store Employee Data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'email',
            'phone' => 'nullable',
        ]);


        Employee::create($formFields);

        return redirect('/employees')->with('message', 'Employee created successfully!');
    }

    // Show Edit Form
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    // Update Employee Data
    public function update(Request $request, Employee $employee)
    {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'email',
            'phone' => 'nullable',
        ]);

        $employee->update($formFields);

        return redirect('/employees')->with('message', 'Employee updated successfully!');
    }

    // Delete Employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/employees')->with('message', 'Employee deleted successfully');
    }
}

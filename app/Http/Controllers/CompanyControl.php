<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyControl extends Controller
{
    // Show all companies
    public function index()
    {
        return view('companies.index', [
            'companies' => Company::latest()->paginate(10)
        ]);
    }

    //Show single Company
    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company
        ]);
    }

    // Show Create Form
    public function create()
    {
        return view('companies.create');
    }

    // Store Company Data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            // 'logo' => 'min:100',
            'email' => 'email',
            'website' => 'nullable',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($formFields);

        return redirect('/companies')->with('message', 'Company created successfully!');
    }

    // Show Edit Form
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    // Update Company Data
    public function update(Request $request, Company $company)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'email',
            'website' => 'nullable',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($formFields);

        return redirect('/')->with('message', 'Company updated successfully!');;
    }

    // Delete Company
    public function destroy(Company $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect('/companies')->with('message', 'Company deleted successfully');
    }
}

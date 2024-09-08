<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $company = Company::first();
        return view('pages.admin.data.company.index', compact('company'));
    }

    public function create()
    {
        return view('pages.admin.data.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = Company::first();
        if (!$company) {
            $company = new Company();
        } else {
            return redirect()->route('super-admin.companies.index')->with('errors', 'Data perusahaan sudah ada');
        }
        $company->company_name = $request->name;
        $company->company_email = $request->email;
        $company->company_phone = $request->phone;
        $company->company_address = $request->address;
        if ($request->hasFile('logo')) {
            $company->company_logo = $request->file('logo')->store('logos', 'public');
        }
        $company->save();
        return redirect()->route('super-admin.companies.index')->with('success', 'Berhasil menambahkan data perusahaan');
    }

    public function edit(Company $company)
    {
        return view('pages.admin.data.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company->company_name = $request->name;
        $company->company_email = $request->email;
        $company->company_phone = $request->phone;
        $company->company_address = $request->address;
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($company->company_logo) {
                Storage::disk('public')->delete(asset('storage/' . $company->company_logo));
            }

            // Simpan logo baru
            $company->company_logo = $request->file('logo')->store('logos', 'public');
        }
        $company->save();
        return redirect()->route('super-admin.companies.index')->with('success', 'Berhasil mengubah data perusahaan');
    }
}

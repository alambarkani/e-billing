<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InternetPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->where('status', true)->latest()
                ->paginate(5);
        } else {
            $customers = Customer::where('status', true)->latest()->paginate(5);
        }
        return view('pages.admin.data.customer.index', compact('customers'));
    }

    public function create()
    {
        $pkgs = InternetPackage::all();
        return view('pages.admin.data.customer.create', compact('pkgs'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:50|string',
            'identity' => 'required|string|unique:customers,identity',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'loc' => 'string',
            'internet_package_id' => 'required',
            'due_date' => 'numeric'
        ]);

        $customer = new Customer();
        $customer->user->name = $request->name;
        $customer->user->account = $request->account;
        $customer->user->password = bcrypt($request->identity);
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->internet_package_id = $request->internet_package_id;
        $customer->save();
        return redirect()->route('admin.data.customer.index')->with('success', 'Data customer ' . $customer->name . ' created successfully');
    }

    public function edit(Customer $customer)
    {
        return view('pages.admin.data.customer.edit', compact('customer'));
    }

    public function update(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'identity' => 'required|string|unique:customers,identity,' . $customer->id,
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'internet_package_id' => 'required',
        ]);
        $customer->update($request->all());
        return redirect()->route('admin.data.customer.index')->with('success', 'Data customer ' . $customer->name . ' updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $folderPath = 'images/' . $customer->identity;

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $customer->delete();
        return redirect()->route('admin.datas.customer.index')->with('success', 'Data customer ' . $customer->name . ' deleted successfully');
    }
}

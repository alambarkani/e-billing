<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\InternetPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;


class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->query(function ($query) {
                $query->where('acc', true)->join('users', 'customers.user_id', 'users.id')
                    ->join('internet_packages', 'customers.internet_package_id', 'internet_packages.id')
                    ->select('customers.*');
            })->paginate(5);
        } else {
            $customers = Customer::where('acc', true)->latest()->paginate(5);
        }
        foreach ($customers as $customer) {
            $customer->due_date = Carbon::parse($customer->due_date);
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
            'due_date' => 'numeric',
            'customer_id' => 'unique:customers,customer_id'
        ]);

        $user = new User();
        $user->name = $request->name;
        do {
            $randomInt = random_int(1000, 9999);
            $exists = User::where('account', $randomInt)->exists();
        } while ($exists);
        $user->account = (string)$randomInt;
        $user->password = (string)random_int(1000, 9999);
        $user->save();

        $due_date = Date::now();
        $due_date->setDay((int)$request->due_date);

        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->customer_id = $request->customer_id;
        $customer->user->name = $request->name;
        $customer->user->account = $request->account;
        $customer->user->password = bcrypt($request->identity);
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->location_name = $request->loc;
        $customer->due_date = $due_date;
        $customer->internet_package_id = $request->internet_package_id;
        $customer->save();
        return redirect()->route('admin.datas.customer.index')->with('success', 'Data customer ' . $customer->name . ' created successfully');
    }

    public function edit(Customer $customer)
    {
        $pkgs = InternetPackage::all();
        return view('pages.admin.data.customer.edit', compact('customer', 'pkgs'));
    }

    public function update(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'customer_id' => 'unique:customers,customer_id,' . $customer->id,
            'identity' => 'required|unique:customers,identity,' . $customer->id,
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'loc' => 'string',
            'due_date' => 'numeric',
            'internet_package_id' => 'required',
            'account' => 'unique:users,account,' . $customer->user->id
        ]);

        $dateString = $customer->due_date;
        $dueDate = Carbon::parse($dateString);
        $dueDate->setDay((int)$request->due_date);

        $customer->user->name = $request->name;
        $customer->customer_id = $request->customer_id;
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->location_name = $request->loc;
        $customer->internet_package_id = $request->internet_package_id;
        $customer->due_date = $dueDate;
        $customer->user->account = $request->account;
        $customer->save();
        return redirect()->route('admin.datas.customer.index')->with('success', 'Data customer ' . $customer->name . ' updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $folderPath = 'images/' . $customer->identity;

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $customer->user->delete();
        return redirect()->route('admin.datas.customer.index')->with('success', 'Data customer ' . $customer->name . ' deleted successfully');
    }

    public function show(Customer $customer)
    {
        return view('pages.admin.data.customer.show', compact('customer'));
    }

    public function paidCustomer(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->query(function ($query) {
                $query->where('paid', true)->join('users', 'customers.user_id', 'users.id')
                    ->join('internet_packages', 'customers.internet_package_id', 'internet_packages.id')
                    ->select('customers.*');
            })->paginate(5);
        } else {
            $customers = Customer::where('paid', true)->latest()->paginate(5);
        }
        foreach ($customers as $customer) {
            $customer->due_date = Carbon::parse($customer->due_date);
        }
        return view('pages.admin.data.customer.paid.index', compact('customers'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->where('acc', true)
                ->paginate(10);
                $customers->appends($request->all());
        } else {
            $customers = Customer::with('product')
                ->where('acc', true)
                ->latest()
                ->paginate(10);
        }

        return view('pages.admin.data.customer.index', compact('customers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('pages.admin.data.customer.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'given_id' => 'unique:customers,given_id',
            'email' => 'required|email|unique:users,email',
            'identity' => 'required|string|unique:customers,identity',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'location' => 'string',
            'product' => 'required',
            'due_date' => 'numeric'
        ]);
        $value = ltrim($request->phone, '0');
        $phone = '62' . $value;

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->identity = $request->identity;
        $customer->phone = $phone;
        $customer->address = $request->address;
        $customer->acc = true;
        $customer->given_id = $request->given_id;
        $customer->status = true;
        $customer->due_date = $request->due_date;
        $customer->product_id = $request->product;
        $customer->save();

        $user = new User();
        $user->email = $request->email;
        $user->userable_id = $customer->id;
        $user->userable_type = Customer::class;

        if(!$request->username){
            $user->username = (string)random_int(1000, 9999);
        } else {
            $user->username = $request->username;
        }
        if(!$request->password){
            $password = (string)random_int(1000, 9999);
        } else {
            $password = $request->password;
        }
        $user->password = bcrypt($password);
        $user->save();

        $notification = Notification::where('type', 'register')->first();

        if($notification) {
            $notification->message .= '<p>account: ' . $user->username . '</p>' . '<p>Password: ' . $password . '</p>';
            sendWhatsappMessage($customer->phone, $notification->message, $notification->sender);
        }

        return redirect()->route('admin.data.customer.index')->with('success', 'Data customer ' . $customer->name . ' created successfully');
    }

    public function edit(Customer $customer)
    {
        $customer = Customer::find($customer->id);
        return view('pages.admin.data.customer.edit', compact('customer'));
    }

    public function update(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|email|unique:users,email,' . $customer->user->id,
            'identity' => 'required|unique:customers,identity,' . $customer->id,
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'product' => 'required',
            'due_date' => 'numeric',
            'given_id' => 'string|unique:customers,given_id,' . $customer->id,
        ]);

        $customer->given_id = $request->given_id;
        $customer->name = $request->name;
        $customer->user->email = $request->email;
        $customer->identity = $request->identity;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->due_date = $request->due_date;
        $customer->product()->associate($request->product);
        $customer->save();

        return redirect()->route('admin.data.customer.index')->with('success', 'Data customer ' . $customer->name . ' updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $folderPath = 'images/' . $customer->identity;

        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }
        $customer->user()->delete();
        $customer->delete();

        return redirect()->route('admin.data.customer.index')->with('success', 'Data customer ' . $customer->name . ' deleted successfully');
    }

    public function show(Customer $customer)
    {
        return view('pages.admin.data.customer.show', compact('customer'));
    }

    public function registrant(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->where('acc', [false])
                ->paginate(10);
            $customers->appends($request->all());
        } else {
            $customers = Customer::where('acc', false)
                ->latest()
                ->paginate(10);
        }

        return view('pages.admin.data.customer.registrant.index', compact('customers'));
    }

    public function registerAcc(Customer $customer)
    {
        $customer->acc = true;
        $customer->status = true;
        $customer->save();

        return redirect()->route('admin.data.customer.registrant.index')->with('success', 'Pendaftaran customer ' . $customer->name . ' telah disetujui');
    }

    public function registerDec(Customer $customer)
    {
        $customer->user()->delete();
        $customer->delete();
        return redirect()->route('admin.data.customer.registrant.index')->with('success', 'Pendaftaran Customer ' . $customer->name . ' telah ditolak');
    }

    public function paid(Request $request)
    {
        if ($request->keyword)
        {
            $customers = Customer::search($request->keyword)->where('acc', true)
                ->where('paid', true)
                ->paginate(10);
        } else {
            $customers = Customer::where('acc', true)
                ->where('paid', true)
                ->latest()
                ->paginate(10);
        }
        return view('pages.admin.data.customer.paid.index', compact('customers'));
    }

    public function notPaid(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->where('acc', true)
                ->where('paid', false)
                ->paginate(10);
        } else {
            $customers = Customer::where('acc', true)
                ->where('paid', false)
                ->latest()
                ->paginate(10);
        }

        return view('pages.admin.data.customer.notpaid.index', compact('customers'));
    }

    public function paidConfirm(Customer $customer)
    {
        $customer->paid = true;
        $customer->save();

        return redirect()->route('admin.data.customer.not-paid')->with('success', 'Status pembayaran ' . $customer->name . ' berhasil dikonfirmasi');
    }

    public function inArrears(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->where('acc', true)
                ->where('in_arrears', true)
                ->paginate(10);
        } else {
            $customers = Customer::where('acc', true)
                ->where('in_arrears', true)
                ->latest()
                ->paginate(10);
        }

        return view('pages.admin.data.customer.arrears.index', compact('customers'));
    }

    public function toggleActivate(Customer $customer)
    {
        $customer->status = !$customer->status;
        $customer->save();

        return redirect()->route('admin.data.customer.index')->with('success', $customer->status ? 'Pelanggan ' . $customer->name . ' telah diaktifkan' : 'Pelanggan ' . $customer->name . ' telah dinonaktifkan');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternetPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InternetPackageController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->keyword) {
            $pkgs = InternetPackage::search($request->keyword)->latest()->paginate(5);
        } else {
            $pkgs = InternetPackage::latest()->paginate(5);
        }

        return view('pages.admin.data.internetPackage.index', compact('pkgs'));
    }

    public function create()
    {
        return view('pages.admin.data.internetPackage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
        ]);

        $priceDecimal = (int)str_replace(['Rp', '.', ' '], '', $request->price);

        $internetPkg = new InternetPackage();
        $internetPkg->name = $request->name;
        $internetPkg->price = $priceDecimal;
        $internetPkg->save();
        return redirect()->route('admin.datas.internetpackage.index')->with(['success' => 'Berhasil Menambahkan Paket Internet']);
    }

    public function edit(InternetPackage $internetpackage)
    {
        return view('pages.admin.data.internetPackage.edit', compact('internetpackage'));
    }

    public function update(InternetPackage $internetPkg, Request $request)
    {

        $request->validate([
            'name' => 'required|max:50|string',
            'price' => 'required|numeric',
        ]);

        $internetPkg->update($request->all());
        return redirect()->route('admin.datas.internetpackage.index')->with(['success' => 'Berhasil mengubah data']);
    }

    public function destroy(InternetPackage $internetpackage): RedirectResponse
    {
        $internetpackage->delete();
        return redirect()->route('admin.datas.internetpackage.index')->with(['success' => 'Berhasil menghapus data']);
    }
}

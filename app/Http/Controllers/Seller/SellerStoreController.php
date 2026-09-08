<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerStoreController extends Controller
{
    // Show create store page
    public function index()
    {
        return view('seller.store.create');
    }

    // Show all stores for the logged-in user
    public function manage()
    {
        $userId = Auth::user()->id;
        $stores = Store::where('user_id', $userId)->get();
        return view('seller.store.manage', compact('stores'));
    }

    // Store a new store
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|min:3|max:155|unique:stores,store_name',
            'slug'       => 'required|unique:stores,slug',
            'description'=> 'required',
        ]);

        Store::create([
            'store_name' => $request->store_name,
            'slug'       => $request->slug,
            'description'=> $request->description,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Store added successfully!');
    }

    // Show edit form
    public function editstore($id)
    {
        $store_info = Store::findOrFail($id);
        return view('seller.store.edit', compact('store_info'));
    }

    // Update a store
    public function updatestore(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $validate_data = $request->validate([
            'store_name'  => 'required|min:3|max:255|unique:stores,store_name,' . $store->id,
            'slug'        => 'required|unique:stores,slug,' . $store->id,
            'description' => 'required',
        ]);

        $store->update($validate_data);

        return redirect()->route('vendor.store.manage')->with('success', 'Store updated successfully!');
    }

    // Delete a store
    public function deletestore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->route('vendor.store.manage')->with('success', 'Store deleted successfully!');
    }
}

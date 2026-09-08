<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
        
        return view('admin.product_attribute.create');
    }
    public function manage()
    {
        $allattributes = DefaultAttribute::all();
        return view('admin.product_attribute.manage', compact('allattributes'));
    }
    public function createattribute(Request $request)
    {
        $validate_data = $request->validate([
        'attribute_value' => 'unique:default_attributes|max:255|min:1',
    ]);

    DefaultAttribute::create($validate_data);

    return redirect()->back()->with('success', 'Default attribute added successfully!');
    }

    public function showattribute($id)
{
    $attri_info = DefaultAttribute::find($id);
    return view('admin.product_attribute.edit', compact('attri_info'));
}

public function updateattribute(Request $request, $id)
{
    $validate_data = $request->validate([
        'attribute_value' => 'unique:default_attributes|max:255|min:3',
    ]);

    $attribute = DefaultAttribute::findOrFail($id);
    $attribute->attribute_value = $validate_data['attribute_value'];
    $attribute ->save();

    return redirect()->back()->with('success', 'Default attribute updated successfully!');
}

public function deleteattribute($id)
{
    $allattribute = DefaultAttribute::findOrFail($id);
    $allattribute->delete();

    return redirect()->back()->with('success', 'Default attribute deleted successfully!');
}
}

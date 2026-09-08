<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SubCategoryController;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class MasterSubcategoryController extends Controller
{
    public function storesubcat(Request $request)
    {
        $validate_data = $request->validate([
            'subcategory_name' => 'unique:subcategories|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($validate_data);

        return redirect()->back()->with('success', 'Subcategory added successfully!');
    }
    public function showsubcat($id)
{
    $subcategory_info = Subcategory::find($id);
    return view('admin.sub_category.edit', compact('subcategory_info'));
}

public function updatesubcat(Request $request, $id)
{
    $validate_data = $request->validate([
            'subcategory_name' => 'unique:subcategories|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
        ]);

    $subcategory = Subcategory::findOrFail($id);
        $subcategory->subcategory_name = $validate_data['subcategory_name'];
        $subcategory->category_id = $validate_data['category_id'];
        $subcategory    ->update($validate_data);

        

    return redirect()->back()->with('success', 'SubCategory updated successfully!');
}

public function deletesubcat($id)
{
    $subcategory = Subcategory::findOrFail($id);
    $subcategory->delete();

    return redirect()->back()->with('success', 'SubCategory deleted successfully!');
}
}

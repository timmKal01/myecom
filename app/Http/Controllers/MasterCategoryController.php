<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function storecat(Request $request)
{
        $validate_data = $request->validate([
        'category_name' => 'unique:categories|max:255|min:3',
    ]);

    Category::create($validate_data);

    return redirect()->back()->with('success', 'Category added successfully!');
}

public function showcat($id)
{
    $category_info = Category::find($id);
    return view('admin.category.edit', compact('category_info'));
}

public function updatecat(Request $request, $id)
{
    $validate_data = $request->validate([
        'category_name' => 'unique:categories|max:255|min:3',
    ]);

    $category = Category::findOrFail($id);
    $category->category_name = $validate_data['category_name'];
    $category->save();

    return redirect()->back()->with('success', 'Category updated successfully!');
}

public function deletecat($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->back()->with('success', 'Category deleted successfully!');
}
} 

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index()
    {
        $authuserid = Auth::id();
        $stores= Store::where('user_id', $authuserid)->get();
        return view('seller.product.create', compact('stores'));
    }
    public function manage()
    {
        $currentUserId = Auth::id();
        $products = Product::where('user_id', $currentUserId)->get();
        return view('seller.product.manage', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000|min:6',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048', // Validate each image
            'slug' => 'required|string|unique:products,slug',
        ]);


        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'description' => $request->description,
            'sku' => $request->input('sku'),
            'user_id' => Auth::id(),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'store_id' => $request->input('store_id'),
            'regular_price' => $request->input('regular_price'),
            'discounted_price' => $request->input('discounted_price'),
            'tax_rate' => $request->input('tax_rate'),
            'stock_quantity' => $request->input('stock_quantity'),
            'slug' => $request->input('slug'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);

        // Handle file uploads
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $path = $file->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'is_primary' => false, // You can set logic to determine primary image if needed
                ]);
            }
        }

        // Here you would typically create the product in the database
        // For demonstration, we'll just return a success message

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    public function editprod(Product $product)
{
    return view('seller.product.edit', compact('product'));
}

    public function updateproduct(Request $request, Product $product)
{
    if ($product->user_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'required|min:6',
        'sku' => 'required|unique:products,sku,' . $product->id,
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'required|exists:subcategories,id',
        'store_id' => 'required|exists:stores,id',
        'regular_price' => 'required|numeric|min:0',
        'discounted_price' => 'nullable|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'slug' => 'required|unique:products,slug,' . $product->id,
        'images.*' => 'nullable|image|max:2048',
    ]);

    $product->update($request->only([
        'product_name',
        'description',
        'sku',
        'category_id',
        'subcategory_id',
        'store_id',
        'regular_price',
        'discounted_price',
        'stock_quantity',
        'slug',
    ]));

    // Add new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('product_images', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'img_path' => $path,
                'is_primary' => false,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product updated successfully');
}
public function deleteproduct($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully.');
}
}

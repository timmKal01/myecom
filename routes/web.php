<?php

use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Storefront\CheckoutController;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\ProductController as StorefrontProductController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('storefront.home');

Route::controller(StorefrontProductController::class)->group(function () {
        Route::get('/shop', 'index')->name('storefront.products.index');
        Route::get('/product/{slug}', 'show')->name('storefront.products.show');
});

Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('/', 'index')->name('storefront.cart.index');
        Route::post('/add/{product}', 'add')->name('storefront.cart.add');
        Route::patch('/update/{product}', 'update')->name('storefront.cart.update');
        Route::delete('/remove/{product}', 'remove')->name('storefront.cart.remove');
});

Route::controller(CheckoutController::class)->prefix('checkout')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'index')->name('storefront.checkout.index');
        Route::post('/', 'store')->name('storefront.checkout.store');
        Route::get('/confirmation/{orderNumber}', 'confirmation')->name('storefront.checkout.confirmation');
});

//Admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
        Route::prefix('admin')->group(function () {
                Route::controller(AdminMainController::class)->group(function () {
                        Route::get('/dashboard', 'index')->name('admin');
                        Route::get('/setting', 'setting')->name('admin.setting');
                        Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
                        Route::get('/manage/stores', 'manage_store')->name('admin.manage.store');
                        Route::get('/cart/history', 'cart_history')->name('admin.cart.history');
                        Route::get('/order/history', 'order_history')->name('admin.order.history');
                });
                Route::controller(CategoryController::class)->group(function () {
                        Route::get('/category/create', 'index')->name('category.create');
                        Route::get('/category/manage', 'manage')->name('category.manage');
                });

                Route::controller(SubCategoryController::class)->group(function () {
                        Route::get('/subcategory/create', 'index')->name('subcategory.create');
                        Route::get('/subcategory/manage', 'manage')->name('subcategory.manage');
                });

                Route::controller(ProductController::class)->group(function () {
                        Route::get('/product/manage', 'index')->name('product.manage');
                        Route::get('/product/review/manage', 'review_manage')->name('product.review.manage');
                });

                Route::controller(ProductAttributeController::class)->group(function () {
                        Route::get('/productattribute/create', 'index')->name('productattribute.create');
                        Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');
                        Route::post('/defaultattribute/create', 'createattribute')->name('attribute.create');
                        Route::get('/defaultattribute/{id}', 'showattribute')->name('show.attribute');
                        Route::put('/defaultattribute/update/{id}', 'updateattribute')->name('update.attribute');
                        Route::delete('/defaultattribute/delete/{id}', 'deleteattribute')->name('delete.attribute');
                });

                Route::controller(ProductDiscountController::class)->group(function () {
                        Route::get('/discount/create', 'index')->name('discount.create');
                        Route::get('/discount/manage', 'manage')->name('discount.manage');
                });

                Route::controller(MasterCategoryController::class)->group(function () {
                        Route::post('/store/category', 'storecat')->name('store.cat');
                        Route::get('/category/{id}', 'showcat')->name('show.cat');
                        Route::put('/category/update/{id}', 'updatecat')->name('update.cat');
                        Route::delete('/category/delete/{id}', 'deletecat')->name('delete.cat');
                });

                Route::controller(MasterSubcategoryController::class)->group(function () {
                        Route::post('/store/subcategory', 'storesubcat')->name('store.subcat');
                        Route::get('/subcategory/{id}', 'showsubcat')->name('show.subcat');
                        Route::put('/subcategory/update/{id}', 'updatesubcat')->name('update.subcat');
                        Route::delete('/subcategory/delete/{id}', 'deletesubcat')->name('delete.subcat');
                });
        });
});

//Vendor routes
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function () {
        Route::prefix('vendor')->group(function () {
                Route::controller(SellerMainController::class)->group(function () {
                        Route::get('/dashboard', 'index')->name('vendor');
                        Route::get('/order/history', 'orderhistory')->name('vendor.order.history');
                });

                Route::controller(SellerProductController::class)->group(function () {
                        Route::get('/product/create', 'index')->name('vendor.product');
                        Route::post('/product/store', 'store')->name('vendor.product.store');
                        Route::get('/product/manage', 'manage')->name('vendor.product.manage');
                        Route::get('/product/{product}/edit', 'editprod')->name('vendor.product.edit');
                        Route::put('/product/{product}', 'updateproduct')->name('vendor.product.update');
                        Route::delete('/product/{product}', 'deleteproduct')->name('vendor.product.delete');
                });

                Route::controller(SellerStoreController::class)->group(function () {
                        Route::get('/store/create', 'index')->name('vendor.store');
                        Route::get('/store/manage', 'manage')->name('vendor.store.manage');
                        Route::get('/store/edit/{id}', 'editstore')->name('edit.store');
                        Route::post('/store/publish', 'store')->name('create.store');
                        Route::put('/store/update/{id}', 'updatestore')->name('update.store');
                        Route::delete('/store/delete/{id}', 'deletestore')->name('delete.store');
                });
        });
});

//user routes
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function () {
        Route::prefix('user')->group(function () {
                Route::controller(CustomerMainController::class)->group(function () {
                        Route::get('/dashboard', 'index')->name('dashboard');
                        Route::get('/order/history', 'history')->name('customer.history');
                        Route::get('/setting/payment', 'payment')->name('customer.payment');
                        Route::get('/affiliate', 'affiliate')->name('customer.affiliate');
                });
        });
});


//Route::get('/customer/dashboard', function () {
//return view('customer');
//})->middleware(['auth', 'verified'])->name('customer');

Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

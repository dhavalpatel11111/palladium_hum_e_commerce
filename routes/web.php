<?php

use App\Http\Controllers\adminUserContriller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\InventoryController;
use App\Models\User;
use App\Models\category;
use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin
Route::any('/admin', function () {
    $User = User::count();
    $category = category::count();
    
    return view('backend/admin/content')->with(compact('User','category'));
});

// category
Route::any('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::any('/admin/category_save', [CategoryController::class, 'save_data'])->name('admin.category_save');
Route::any('/admin/category_list', [CategoryController::class, 'list_data'])->name('admin.list_data');
Route::any('/admin/category_edit', [CategoryController::class, 'edit_data'])->name('admin.edit_data');
Route::any('/admin/category_delete', [CategoryController::class, 'delete_data'])->name('admin.delete_data');



// sub-category
Route::get('/admin/sub_category', [SubCategoryController::class, 'index'])->name('admin.sub_category');
Route::any('/admin/sub_category_list', [SubCategoryController::class, 'sub_category_list'])->name('admin.sub_category_list');
Route::any('/admin/sub_category_save', [SubCategoryController::class, 'save_data'])->name('admin.sub_category_save');
Route::any('/admin/category_data', [SubCategoryController::class, 'category_data'])->name('admin.category_data');
Route::any('/admin/edit_sub_category_data', [SubCategoryController::class, 'edit_sub_category_data'])->name('admin.edit_sub_category_data');
Route::any('/admin/delete_sub_category_data', [SubCategoryController::class, 'delete_sub_category_data'])->name('admin.delete_sub_category_data');



// product
Route::get('/admin/product', [SubCategoryController::class, 'index'])->name('admin.product');



// user
Route::get("/admin/user" , [adminUserContriller::class , 'index']);
Route::any('/admin/Add_user', [adminUserContriller::class, 'Add_user']);
Route::any('/admin/user_list', [adminUserContriller::class, 'user_list']);
Route::any('/admin/edit_user', [adminUserContriller::class, 'edit_user']);
Route::any('/admin/delete_user', [adminUserContriller::class, 'delete_user']);

// Inventory
Route::get("/admin/Inventory" , [InventoryController::class , 'index']);






// frontend

// Route::any('/', function () {
//     return view('Frontend.index');
// });

Route::any('/' , [Frontend::class , 'index']);

Route::any('/shop', function () {
    return view('Frontend.shop');
});

Route::any('/about', function () {
    return view('Frontend.about');
});

Route::any('/services', function () {
    return view('Frontend.services');
});

Route::any('/blog', function () {
    return view('Frontend.blog');
});

Route::any('/contact', function () {
    return view('Frontend.contact');
});

Route::any('/cart', function () {
    return view('Frontend.cart');
});

Route::any('/checkout', function () {
    return view('Frontend.checkout');
});

Route::any('/seller', function () {
    return view('Frontend.seller');
});

Route::any('/thankyou', function () {
    return view('Frontend.thankyou');
});




Route::any("/category/{id}" , [Frontend::class , "category_find"]);
Route::any("/sub_category_data/{id}" , [Frontend::class , "sub_category_data_find"]);
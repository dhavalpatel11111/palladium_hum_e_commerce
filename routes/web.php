<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
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
    return view('backend/admin/content');
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














// frontend

Route::any('/', function () {
    return view('Frontend.index');
});



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

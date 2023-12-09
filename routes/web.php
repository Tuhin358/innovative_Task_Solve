<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify' => true]);
Route::get('/', function () {
    return redirect()->route('admin_dashboard');
});


Route::get('/home', function () {
    return redirect()->route('admin_dashboard');
});

Route::post('/user-login', [LoginController::class, 'LOGIN'])->name('LOGIN');

#~~~~~~~~~~~~ all admin panel routes ~~~~~~~~~~~~~~

Route::group(['prefix' => 'admin','middleware' => ['auth', 'role:admin']], function() {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');

    #~~~~~~~~~~~~ all Products ~~~~~~~~~~~~~~

    Route::get('/products-index', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products-create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products-store', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/product-edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/product-update/{id}', [ProductsController::class, 'update'])->name('product.update');
    Route::get('/product-destroy/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');
    Route::get('/view-product', [ProductsController::class, 'view'])->name('view.product');

     #~~~~~~~~~~~~ all Employee ~~~~~~~~~~~~~~
     Route::get('/employee-index', [EmployeeController::class, 'index'])->name('employee.index');
     Route::get('/employee-create', [EmployeeController::class, 'create'])->name('employee.create');
     Route::post('/employee-store', [EmployeeController::class, 'store'])->name('employee.store');
     Route::get('/employee-edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
     Route::post('/employee-update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
     Route::get('/employee-destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');




















    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'profile_edit'])->name('profile_edit');
    Route::post('/profile/update', [ProfileController::class, 'profile_update'])->name('profile_update');

    Route::get('/role-management', [RoleManagementController::class, 'index'])->name('role_management');
    Route::post('/role-management/add', [RoleManagementController::class, 'role_add'])->name('role_add');
    Route::get('/role-management/delete/{id}', [RoleManagementController::class, 'role_delete'])->name('role_delete');
    Route::post('/role-management/update', [RoleManagementController::class, 'role_update'])->name('role_update');
    Route::get('/get-role/{id}', [RoleManagementController::class, 'get_role'])->name('get_role');


    Route::post('/permission-management/add', [RoleManagementController::class, 'permission_add'])->name('permission_add');
    Route::get('/permission-management/delete/{id}', [RoleManagementController::class, 'permission_delete'])->name('permission_delete');
    Route::post('/permission-management/update', [RoleManagementController::class, 'permission_update'])->name('permission_update');
    Route::get('/get-permission/{id}', [RoleManagementController::class, 'get_permission'])->name('get_permission');
    Route::get('/fetch-permissions-by-role/{id}', [RoleManagementController::class, 'fetch_permissions'])->name('fetch_permissions_by_role');


    Route::post('/role-permission-assign', [RoleManagementController::class, 'role_permission_assign'])->name('role_permission_assign');
    Route::get('/role-permission-revoke/{id}', [RoleManagementController::class, 'role_permission_revoke'])->name('role_permission_revoke');

    Route::resource('users', UserController::class);



});

Route::get('/index', function () {
    return view('frontend.index');
});

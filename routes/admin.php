<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AuthController;
use App\Admin\Controllers\RoomController;
use App\Admin\Controllers\AccountController;
use App\Admin\Controllers\InvoiceController;
use App\Admin\Controllers\ContractController;
use App\Admin\Controllers\CustomerController;
use App\Admin\Controllers\AdminHomeController;
use App\Admin\Controllers\WorkBoardController;
use App\Admin\Controllers\RoleManagerController;
use App\Admin\Controllers\RoomManagerController;
use App\Admin\Controllers\FloorManagerController;
use App\Admin\Controllers\AdminBuildingController;
use App\Admin\Controllers\BuildingManagerController;
use App\Admin\Controllers\ContractEarnestController;
use App\Admin\Controllers\CustomerManagerController;
use App\Admin\Controllers\PermissionManagerController;
use App\Admin\Controllers\ContractServiceDetailController;
use App\Admin\Controllers\ExportPDF;
use App\Admin\Controllers\CommissionController;
use App\Admin\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dang-nhap', [AuthController::class, 'getLogin'])->name('admin.getLogin');
Route::post('dang-nhap', [AuthController::class, 'postLogin'])->name('admin.postLogin');

Route::get('/', function(){
    return redirect()->route('dashboard.index');
});
Route::get('/send-mail-test', [InvoiceController::class, 'sendMailInvoice']);

Route::group(['middleware' => ['admin']], function () {
    Route::prefix('ho-so-khach-hang')->group(function(){
        Route::get('show-select', [CustomerController::class, 'showSelectCustomer'])->name('customer.showSelect');
        Route::get('get-datatable', [CustomerController::class, 'indexDatatable'])->name('customer.indexDatatable');
        Route::get('get-datatable-edit/{id}', [CustomerController::class, 'indexDatatableEdit'])->name('customer.indexDatatableEdit');
        Route::get('get-select-ajax', [CustomerController::class, 'dataAjax'])->name('customer.selectAjax');
        Route::get('get-customer-info', [CustomerController::class, 'getCustomerInfo'])->name('customer.getInfo');

    });
    Route::prefix('phong')->group(function(){
        Route::get('/get-change-status', [RoomController::class, 'getChangeStatus'])->name('phong.getChangeStatus');
        Route::post('/post-change-status', [RoomController::class, 'postChangeStatus'])->name('phong.postChangeStatus');

    });
    Route::prefix('hop-dong')->group(function(){
        Route::get('/hop-dong-den-han', [ContractController::class, 'managerContractExpired'])->name('hop-dong.expired');
        Route::get('/kiem-duyet/{id_contract}', [ContractController::class, 'getProcessContract'])->name('hop-dong.getProcess');
        Route::get('/kiem-duyet/{id}/{status}', [ContractController::class, 'runProcessContract'])->name('hop-dong.runProcess');
    });
    Route::resources([
        '/dashboard' => AdminHomeController::class,
        '/quan-ly-admin' => AccountController::class,
        '/ban-lam-viec' => WorkBoardController::class,
        '/ho-so-khach-hang' => CustomerController::class,
        '/hop-dong' => ContractController::class,
        '/phong' =>RoomController::class,
        '/hop-dong-coc' => ContractEarnestController::class,
        '/chi-so-dich-vu' => ContractServiceDetailController::class,
        '/hoa-don' => InvoiceController::class,
    ]);
  



    Route::group(['prefix' => 'co-so', 'middleware' => ['permission:Quản trị cơ sở,admin']], function(){
        Route::get('/', [BuildingManagerController::class, 'index'])->name('admin.building.index');
        Route::get('show/{building:id}', [BuildingManagerController::class, 'show'])->name('admin.building.show');
        Route::get('create', [BuildingManagerController::class, 'create'])->name('admin.building.create');
        Route::get('edit/{building:id}', [BuildingManagerController::class, 'edit'])->name('admin.building.edit');
        Route::post('store', [BuildingManagerController::class, 'store'])->name('admin.building.store');
        Route::put('update', [BuildingManagerController::class, 'update'])->name('admin.building.update');
        Route::delete('delete/{building:id}', [BuildingManagerController::class, 'delete'])->name('admin.building.delete');

        Route::prefix('tang')->group(function(){
            Route::get('edit/{floor:id}', [FloorManagerController::class, 'edit'])->name('admin.floor.edit');
            Route::put('update', [FloorManagerController::class, 'update'])->name('admin.floor.update');
            Route::delete('delete/{floor:id}', [FloorManagerController::class, 'delete'])->name('admin.floor.delete');
        });
    });
    Route::group(['prefix' => 'phong', 'middleware' => ['permission:Quản trị cơ sở|Bàn làm việc,admin']], function(){
        Route::get('show-quickly/{room:id}', [RoomManagerController::class, 'showQuickly'])->name('admin.room.show.quickly');
    });

    Route::group(['prefix' => 'phan-quyen', 'middleware' => ['permission:Vai trò|Người dùng,admin']], function () {
        //
        Route::resource('roles', RoleManagerController::class);
        Route::resource('permissions', PermissionManagerController::class);
        Route::post('xu-ly-nhieu-role', [RoleManagerController::class,'multiple'])->name('roles.multiple');
        Route::post('xu-ly-nhieu-permission', [PermissionManagerController::class,'multiple'])->name('permissions.multiple');
    });
    Route::group(['prefix' => 'khach-hang', 'middleware' => ['permission:Hồ sơ khách hàng,admin']], function(){
        Route::get('/', [CustomerManagerController::class, 'index'])->name('admin.customer.index');
        Route::get('create', [CustomerManagerController::class, 'create'])->name('admin.customer.create');
        Route::post('store', [CustomerManagerController::class, 'store'])->name('admin.customer.store');

        Route::get('edit/{customer:id}', [CustomerManagerController::class, 'edit'])->name('admin.customer.edit');
        Route::put('update', [CustomerManagerController::class, 'update'])->name('admin.customer.update');
        Route::delete('delete/{customer:id}', [CustomerManagerController::class, 'delete'])->name('admin.customer.delete');
        Route::delete('xu-ly-nhieu-khach-hang', [CustomerManagerController::class,'multiple'])->name('admin.customer.multiple');

    });

    Route::group(['prefix' => 'pdf', 'as' => 'pdf.'], function(){
        Route::get('invoice/{invoice:id}', [ExportPDF::class, 'invoice'])->name('invoice');
        Route::get('contract/{contract:id}', [ExportPDF::class, 'contract'])->name('contract');
    });
    Route::group(['prefix' => 'hoa-hong', 'as' => 'admin.commission.'], function(){
        Route::get('/', [CommissionController::class, 'index'])->name('index');
        Route::put('/multiple', [CommissionController::class, 'multiple'])->name('multiple')->middleware('role:'.config('custom.role-admin').',admin');
    });

    Route::group(['prefix' => 'cai-dat', 'as' => 'admin.setting.', 'middleware' => ['role:'.config('custom.role-admin').',admin']], function(){
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/update', [SettingController::class, 'update'])->name('update');
    });

    Route::post('dang-xuat', [AuthController::class, 'logout'])->name('admin.logout');
});

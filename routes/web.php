<?php

use App\Http\Controllers\AsramaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPaketController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('master-management')->group(function () {
        //asrama
        Route::resource('asrama', AsramaController::class);
        Route::post('/asrama/list', [AsramaController::class, 'list'])->name('asrama.list');

        //kategori-paket
        Route::resource('kategori-paket', KategoriPaketController::class);
        Route::post('/kategori-paket/list', [KategoriPaketController::class, 'list'])->name('kategori-paket.list');
    });

    Route::prefix('transaksi-management')->group(function () {
        //paket
        Route::resource('paket', PaketController::class);
        Route::post('/paket/list', [PaketController::class, 'list'])->name('paket.list');
        Route::patch('/paket/{id_paket}/status/{status}', [PaketController::class, 'updateStatus'])->name('paket.updateStatus');
        Route::get('/paket/{id_paket}/disita/edit', [PaketController::class, 'editDisita'])->name('paket.disita.edit');
        Route::put('/paket/{id_paket}/disita', [PaketController::class, 'updateDisita'])->name('paket.disita.update');
        Route::get('/paket/export-masuk/download', [PaketController::class, 'exportPaketMasuk'])->name('paket.export.masuk');
        Route::get('/paket/export-keluar/download', [PaketController::class, 'exportPaketKeluar'])->name('paket.export.keluar');
    });

    Route::prefix('laporan-management')->group(function () {
        //laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('/laporan/list', [LaporanController::class, 'list'])->name('laporan.list');
    });

    Route::prefix('user-management')->group(function () {
        // santri
        Route::resource('santri', SantriController::class);
        Route::post('/santri/list', [SantriController::class, 'list'])->name('santri.list');
        Route::get('/santri/view/import', [SantriController::class, 'showImportForm'])->name('view.santri.import');
        Route::post('/santri/import/store', [SantriController::class, 'import'])->name('santri.import');
        Route::get('/santri/export/download', [SantriController::class, 'exportSantri'])->name('santri.export');
        Route::get('/santri/{santri}/export-pdf', [SantriController::class, 'exportPdf'])->name('santri.exportPdf');

        Route::resource('user', UserController::class);
        Route::post('/user/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/user/export/download', [UserController::class, 'exportUsers'])->name('user.export');
    });


    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::post('/menu-group/list', [MenuGroupController::class, 'list'])->name('menu-group.list');

        Route::resource('menu-item', MenuItemController::class);
        Route::post('/menu-item/list', [MenuItemController::class, 'list'])->name('menu-item.list');
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::post('/role/list', [RoleController::class, 'list'])->name('role.list');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::post('/permission/list', [PermissionController::class, 'list'])->name('permission.list');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');
        Route::post('/assign/list', [AssignPermissionController::class, 'list'])->name('assign.list');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assign-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
        Route::post('/assign-user/list', [AssignUserToRoleController::class, 'list'])->name('assign.user.list');
    });
});

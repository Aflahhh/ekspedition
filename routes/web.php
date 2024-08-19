<?php

use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardPostsController;
use Illuminate\Session\Middleware\AuthenticateSession;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome', [
        'title' => "Cv. Putra Ardiansyah",
        'active' => 'welcome'
    ]);
});



// route dinamis dapatkan alamat kirim
Route::get('biaya/get_alamat_kirim', [BiayaController::class, 'getAlamatKirim'])->name('get_alamat_kirim');

// route dinamis dapatkan ongkos angkut
Route::get('biaya/get_ongkos_angkut', [BiayaController::class, 'getOngkosAngkut'])->name('get_ongkos_angkut');

// route dinamis dapatkan detail armada
Route::get('/get-armada-details', [RegisteredUserController::class, 'getArmadaDetails'])->name('getArmadaDetails');

// route dinamis dapatkan detail driver
Route::get('/get-driver-details', [TransaksiController::class, 'getDriverDetails'])->name('get_driver_details');

// route dinamis dapatkan id biaya
Route::get('/get-id-biaya', [BiayaController::class, 'getIdBiaya'])->name('get_id_biaya');

// route dinamis hapus semua data / data yang dipilih
Route::post('/dashboard/posts/delete-selected', [TransaksiController::class, 'deleteSelected'])->name('posts.deleteSelected');

Route::post('/dashboard/posts/delete-all', [TransaksiController::class, 'deleteAll'])->name('posts.deleteAll');





Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/dashboard/profil', ProfilController::class)->middleware('auth');


// route transaksi

Route::get('/dashboard', [TransaksiController::class, 'index'])->name('dashboard');
Route::get('/print/excel', [PrintController::class, 'index']);
Route::get('/dashboard/posts', [TransaksiController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/posts/create', [TransaksiController::class, 'create'])->middleware('auth');
Route::post('/dashboard/posts/create', [TransaksiController::class, 'store'])->name('transaksi.store');


Route::get('/dashboard/posts/{transaksi}', [TransaksiController::class, 'show'])->middleware('auth');
Route::get('/dashboard/posts/{transaksi}/edit', [TransaksiController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/posts/{transaksi}', [TransaksiController::class, 'update'])->middleware('auth');
Route::delete('/dashboard/posts/{transaksi}', [TransaksiController::class, 'destroy'])->name('delete');

// end route transaksi

// route porfile

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// end route profile

// route kirim file via email
Route::get('/dashboard/kirim/upload', [FileController::class, 'index']);

// end route kirim file via email

// route panduan

Route::get('/panduan', [PanduanController::class, 'index']);

// end route panduan

// ---------------------------------------------------------------------------------------------

// route admin
Route::resource('/dashboard/print', AdminController::class);
Route::post('/dashboard/print', [AdminController::class, 'print'])->name('print.data');
// route kirim email
Route::resource('/dashboard/kirim', EmailController::class);
Route::post('/dashboard/kirim', [EmailController::class, 'store'])->name('send-email');
// route user
Route::get('/dashboard/user', [AdminController::class, 'userIndex']);
Route::get('/dashboard/user/create', [AdminController::class, 'createUser']);
Route::post('/dashboard/user/create', [AdminController::class, 'storeUser'])->name('user.post');
Route::get('/dashboard/user/{user}', [AdminController::class, 'showUser']);
Route::get('/dashboard/user/{user}/edit', [AdminController::class, 'editUser']);
Route::put('/dashboard/user/{user}', [AdminController::class, 'updateUser'])->name('user.update');
Route::delete('/dashboard/user/{id}', [AdminController::class, 'destroyUser'])->name('delete.user');


// -----------------------------------------------------------------------------------------------

// route armada
Route::resource('/dashboard/armada', ArmadaController::class);
Route::get('/dashboard/armada/create', [ArmadaController::class, 'create']);
Route::post('/dashboard/armada/create', [ArmadaController::class, 'store'])->name('post.armada');
Route::get('/dashboard/armada/{armada}/edit', [ArmadaController::class, 'edit']);
Route::put('/dashboard/armada/{armada}', [ArmadaController::class, 'update'])->name('armada.update');
Route::delete('/dashboard/armada/{id_armada}', [ArmadaController::class, 'destroy'])->name('delete.armada');
Route::get('/api/get-armada/{nomor_polisi}', [ArmadaController::class, 'getArmadaByNomorPolisi']);

// -----------------------------------------------------------------------------------------------

// route biaya
Route::get('/dashboard/biaya', [BiayaController::class, 'index']);
Route::get('/dashboard/biaya/create', [BiayaController::class, 'create']);
Route::post('/dashboard/biaya/create', [BiayaController::class, 'store'])->name('post.biaya');
Route::get('/dashboard/biaya/{cost}/edit', [BiayaController::class, 'edit']);
Route::put('/dashboard/biaya/{cost}', [BiayaController::class, 'update'])->name('biaya.update');
Route::delete('/dashboard/biaya/{id_biaya}', [BiayaController::class, 'destroy'])->name('delete.biaya');

// route customer
Route::get('/dashboard/customer', [CustomerController::class, 'index']);
Route::get('/dashboard/customer/create', [CustomerController::class, 'create']);
Route::post('/dashboard/customer/create', [CustomerController::class, 'store'])->name('post.customer');
Route::post('/add-customer', [CustomerController::class, 'addNameCustomer']);
Route::post('/dashboard/customer/{customer}', [CustomerController::class, 'update'])->name('update.customer');
Route::get('/dashboard/customer/{customer}/edit', [CustomerController::class, 'edit']);
Route::delete('/dashboard/customer/{id_customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');


// route image
Route::get('/dashboard/image', [ImageController::class, 'index']);


require __DIR__ . '/auth.php';

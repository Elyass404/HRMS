# HRMS

## the routes:
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\LeaveController;
use App\Models\Department;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::resource('leaves', LeaveController::class);


Route::group(['middleware' => ['role:Manager,Admin,HR,Employee']], function () {
Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
Route::post('/leaves/store', [LeaveController::class, 'store'])->name('leaves.store');
Route::delete('/leaves/{id}', [LeaveController::class, 'destroy'])->name('leaves.destroy');




});


Route::group(['middleware' => ['role:Admin,HR,Manager']], function () {
    Route::resource('users', UserController::class);
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
Route::get('/leaves/{id}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
});


Route::group(['middleware' => ['role:Admin,HR']], function () {
    Route::resource('positions', PositionController::class);
    Route::resource('contract-types', ContractTypeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
 
});


Route::group(['middleware' => ['role:Admin']], function () {
    


});

Route::resource('leaves', LeaveController::class);



require __DIR__.'/auth.php';

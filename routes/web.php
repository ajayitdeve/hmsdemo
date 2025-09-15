<?php

use App\Http\Livewire\Datatable\AllConsultation;
use App\Http\Livewire\Role\RoleStockPointMaster;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Livewire\Master\Employee\EmployeeCreate;
use App\Http\Livewire\Master\Employee\EmployeeEdit;
use App\Http\Livewire\Master\Employee\EmployeeList;
use App\Http\Livewire\User\UserCreate;
use App\Http\Livewire\User\UserEdit;
use App\Http\Livewire\User\UserProfileMaster;
use App\Http\Livewire\User\UserProfileStockPointMaster;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return view('auth.login');
    }
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/employee', EmployeeList::class)->name('employee');
    Route::get('/employee/create', EmployeeCreate::class)->name('employee.create');
    Route::get('/employee/{id}/edit', EmployeeEdit::class)->name('employee.edit');

    Route::get('user-profile', UserProfileMaster::class)->name('user-profile.index');
    Route::get('user-profile/stock-point', UserProfileStockPointMaster::class)->name('user-profile.stock-point');

    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{id}/edit', UserEdit::class)->name('users.edit');
});

//Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    //Roles & Permissions Routes
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

    // Route::get('/role/stock-points', RoleStockPointMaster::class)->name('role-stock-points');

    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    Route::resource('users', UserController::class)->except(['create']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/sync/team-role/{id}', [UserController::class, 'sync_team_role'])->name('users.sync_team_role');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');

    //admin pharmacy dashboard
    Route::get('/pharmacy-dashboard', [AdminController::class, 'pharmacy_dashboard'])->name('pharmacy-dashboard');
    //datatable -livewire test
    Route::get('/datatable-livewire', AllConsultation::class);
});

Route::middleware(['auth', 'role:user'])->name('user.')->prefix('/user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});


Route::get('select-search', function () {
    return view('select-search');
});

\Illuminate\Support\Facades\Auth::routes();
//other Routes
Route::get('/barcode', function () {
    // echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+", 3, 33) . '" alt="barcode"   />';
    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("455544", "C39", 5, 60) . '" alt="barcode"   />';
});
Route::get('/morph', function () {
    $x = \App\Models\Patient::find(1)->with('referral')->get();
    dd($x->toArray());
});
//testing email
Route::get('sendemail', function () {
    Mail::to('tarkeshwarsgit@gmail.com')->send(new \App\Mail\TestEmail);
    return "success";
});

Route::get('/admin/permission/policy', function () {
    $permissions = Permission::where('guard_name', 'web')->get();

    foreach ($permissions as $permission) {
        echo "public function " . $permission->name . '(?User $user){';
        echo "<br/>";
        echo 'return $user->can(\'' . $permission->name . '\');';
        echo "<br/>";
        echo '}';
        echo "<br/>";
    }
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');

    return to_route('admin.dashboard');
});

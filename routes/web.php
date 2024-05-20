<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['admin']], function()
{


    // Permission
    Route::get('/admin/gestion/permission', [PermissionController::class, 'index'])->name('admin.gestionPermission');
    Route::post('/admin/permission', [PermissionController::class, 'store'])->name('ajouterPermission.store');
    Route::put('/admin/{id}/permission', [PermissionController::class, 'update'])->name('admin.updatePermission');
    Route::delete('/admin/{id}/permission', [PermissionController::class, 'delete'])->name('admin.deletePermission');  
    // Role
    Route::get('/admin/gestion/role', [RoleController::class, 'index'])->name('admin.gestionRole');
    Route::post('/admin/role', [RoleController::class, 'store'])->name('ajouterRole.store');
    Route::put('/admin/{id}/role', [RoleController::class, 'update'])->name('admin.updateRole');
    Route::delete('/admin/{id}/role', [RoleController::class, 'delete'])->name('admin.deleteRole')
        ->middleware('permission:delete role');  
    Route::get('/admin/gestion/role/{id}/givePermission', [RoleController::class, 'addPermissionToRole'])->name('admin.addPermissionToRole');
    Route::put('/admin/gestion/role/{id}/givePermission', [RoleController::class, 'givePermissionToRole'])->name('admin.givePermissionToRole');
    //User
    Route::get('admin/user',[HomeController::class,'index'])->middleware(['auth','admin'])->name('admin.gestionUser');
    Route::get('/admin/create/user', [HomeController::class, 'createUser'])->name('admin.createUser');
    Route::post('/admin/user', [HomeController::class, 'storeUser'])->name('createUser.store');
    Route::get('admin/{id}/show/user',[HomeController::class,'showUser'])->middleware(['auth','admin'])->name('admin.showUser');
    Route::get('/admin/{id}/edit/user', [HomeController::class, 'userEdit'])->name('admin.editUser');
    Route::put('/admin/{id}/user', [HomeController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/{id}/user', [HomeController::class, 'deleteUser'])->name('admin.deleteUser');   

    Route::post('/admin/block-user/{id}', [HomeController::class, 'blockerUser'])->name('admin.blockUser');
    Route::post('/admin/unblock-user/{id}', [HomeController::class, 'unblockerUser'])->name('admin.unblockUser');
    Route::post('/admin/validate/{id}', [HomeController::class, 'validateUser'])->name('admin.validateUser');

    //villes
    Route::get('/admin/gestion/ville', [HomeController::class, 'gestionVille'])->name('admin.gestionVille');
    Route::post('/admin/ville', [HomeController::class, 'storeVille'])->name('ajouterVille.store');
    Route::put('/admin/{id}/ville', [HomeController::class, 'updateVille'])->name('admin.updateVille');
    Route::delete('/admin/{id}/ville', [HomeController::class, 'deleteVille'])->name('admin.deleteVille');  

    //agences
    Route::get('/admin/create/agence', [HomeController::class, 'gestionAgence'])->name('admin.gestionAgence');
    Route::post('/admin/agence', [HomeController::class, 'storeAgence'])->name('ajouterAgence.store');
    Route::put('/admin/{id}/agence', [HomeController::class, 'updateAgence'])->name('admin.updateAgence');
    Route::delete('/admin/{id}/agence', [HomeController::class, 'deleteAgence'])->name('admin.deleteAgence');
    
    //type de tickes
    Route::get('/admin/create/TypeTicket', [HomeController::class, 'gestionTypeTicket'])->name('admin.gestionTypeTicket');
    Route::post('/admin/TypeTicket', [HomeController::class, 'storeTypeTicket'])->name('ajouterTypeTicket.store');
    Route::put('/admin/{id}/TypeTicket', [HomeController::class, 'updateTypeTicket'])->name('admin.updateTypeTicket');
    Route::delete('/admin/{id}/TypeTicket', [HomeController::class, 'deleteTypeTicket'])->name('admin.deleteTypeTicket');

    //type de documents
    Route::get('/admin/create/TypeDocument', [HomeController::class, 'gestionTypeDocument'])->name('admin.gestionTypeDocument');
    Route::post('/admin/TypeDocument', [HomeController::class, 'storeTypeDocument'])->name('ajouterTypeDocument.store');
    Route::put('/admin/{id}/TypeDocument', [HomeController::class, 'updateTypeDocument'])->name('admin.updateTypeDocument');
    Route::delete('/admin/{id}/TypeDocument', [HomeController::class, 'deleteTypeDocument'])->name('admin.deleteTypeDocument');
});
Route::get('user/ticket',[TicketController::class,'index'])->name('user.gestionTicket');
Route::get('/user/create/ticket', [TicketController::class, 'CreateTicket'])->name('user.createTicket');
Route::post('/user/ticket', [TicketController::class, 'storeTicket'])->name('createTicket.store');
Route::get('/user/{id}/edit/ticket', [TicketController::class, 'ticketEdit'])->name('user.editTicket');
Route::put('/user/{id}/ticket', [TicketController::class, 'updateTicket'])->name('user.updateTicket');
Route::put('/user/{id}/ticket/doc', [TicketController::class, 'updateDocTicket'])->name('user.updateDocTicket');
Route::delete('/user/{id}/ticket', [TicketController::class, 'deleteTicket'])->name('user.deleteTicket');
Route::delete('/user/{id}/document', [TicketController::class, 'deleteDocument'])->name('user.deleteDocument');
Route::post('/user/clotuerTicket/{id}', [TicketController::class, 'cloturerTicket'])->name('user.cloturerTicket');
Route::get('user/{id}/show/ticket',[TicketController::class,'showTicket'])->name('user.showTicket');
Route::post('/cancel-ticket', [TicketController::class, 'cancelTicket'])->name('cancel-ticket');
Route::get('export-tickets', function (Request $request) {
    return Excel::download(new TicketsExport($request), 'tickets.xlsx');
})->name('exportTickets');

Route::get('/user', function () {
    return view('user.dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'dashboard'])->middleware(['auth','admin'])->name('admin.dashboard');













Route::put('/admin/{id}/update-password', [HomeController::class, 'updatePassword'])->name('admin.updateUserPassword');



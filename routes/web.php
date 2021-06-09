<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\MyAccount;
use App\Http\Controllers\User\MyChars;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\ManagerCashController;
use App\Http\Controllers\Admin\ManagerVipController;
use App\Http\Controllers\Admin\ManagerStaffController;
use App\Http\Controllers\Admin\ManagerBanController;
use App\Http\Controllers\Rankings\GVGController;
use App\Http\Controllers\Rankings\MVPController;
use App\Http\Controllers\Rankings\ZenyController;
use App\Http\Controllers\Rankings\PVPController;
use App\Http\Controllers\Rankings\EventController;
use App\Http\Controllers\Database\DatabaseController;
use App\Http\Controllers\Tickets\TicketsController;
use App\Http\Controllers\Admin\ManagerTicketController;
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

// Página inicial
Route::get('/',[IndexController::class, 'index'])->middleware('verify')->name('index');

// Usuário.
Route::get('/register',[RegisteredUserController::class, 'index'])->name('user.index.register');
Route::post('/register',[RegisteredUserController::class, 'register'])->name('user.register');
Route::get('/login',[AuthenticatedSessionController::class, 'index'])->name('user.index.login');
Route::post('/login',[AuthenticatedSessionController::class, 'authenticate'])->name('user.login');
Route::match(['post', 'get'],'/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('user.logout');

// Reset Senha
Route::get('/forgot-password', function () {
    return view('user.reset-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.request.send');

Route::get('/reset-password/{token}', function ($token) {
    return view('user.change-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

// Verificação de E-mail

Route::get('/email/verify', function () {
    return view('user.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return view('user.login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [RegisteredUserController::class, 'verification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/myaccount',[MyAccount::class, 'index'])->middleware('auth', 'verified')->name('user.myaccount');
Route::post('/myaccount',[MyAccount::class, 'update'])->middleware('auth')->name('user.myaccount.update');
Route::post('/myaccount/upload',[MyAccount::class, 'uploadimg'])->middleware('auth')->name('user.myaccount.upload');
Route::get('/mychars',[MyChars::class, 'index'])->middleware('auth')->name('user.mychars');
Route::post('/mychars/resetposition',[MyChars::class, 'resetPosition'])->middleware('auth')->name('user.resetposition');
Route::post('/mychars/resetstyle',[MyChars::class, 'resetStyle'])->middleware('auth')->name('user.resetstyle');

// Tickets
Route::get('/tickets',[TicketsController::class, 'index'])->middleware('auth')->name('tickets.index');
Route::post('/tickets',[TicketsController::class, 'send'])->middleware('auth')->name('tickets.send');
Route::get('/tickets/my',[TicketsController::class, 'myTickets'])->middleware('auth')->name('tickets.mytickets');
Route::get('/tickets/view/{id}',[TicketsController::class, 'ticketView'])->middleware('auth')->name('tickets.ticketview');
Route::post('/tickets/reply',[TicketsController::class, 'reply'])->middleware('auth')->name('tickets.reply');

// Rankings
Route::get('/rankings/woe',[GVGController::class, 'index'])->name('rankings.woe');
Route::get('/rankings/mvp',[MVPController::class, 'index'])->name('rankings.mvp');
Route::get('/rankings/zeny',[ZenyController::class, 'index'])->name('rankings.zeny');
Route::get('/rankings/pvp',[PVPController::class, 'index'])->name('rankings.pvp');
Route::get('/rankings/event',[EventController::class, 'index'])->name('rankings.event');

// Databases.
Route::get('/database/item', [DatabaseController::class, 'item'])->name('database.item');
Route::post('/database/item', [DatabaseController::class, 'itemSearch'])->name('database.search.item');
Route::get('/database/monster', [DatabaseController::class, 'monster'])->name('database.monster');
Route::post('/database/monster', [DatabaseController::class, 'monsterSearch'])->name('database.search.monster');

// Administrador.
// Logs
Route::get('/admin/logs',[LogsController::class, 'index'])->middleware('auth', 'admin')->name('admin.logs');
// Gerenciar Cash
Route::get('/admin/managercash',[ManagerCashController::class, 'index'])->middleware('auth', 'admin')->name('admin.managercash');
Route::post('/admin/managercash/add',[ManagerCashController::class, 'add'])->middleware('auth', 'admin')->name('admin.managercash.add');
Route::post('/admin/managercash/remove',[ManagerCashController::class, 'remove'])->middleware('auth', 'admin')->name('admin.managercash.remove');
Route::post('/admin/managercash',[ManagerCashController::class, 'find'])->middleware('auth', 'admin')->name('admin.managercash.find');
// Gerenciar VIP
Route::get('/admin/managervip',[ManagerVipController::class, 'index'])->middleware('auth', 'admin')->name('admin.managervip');
Route::post('/admin/managervip/add',[ManagerVipController::class, 'add'])->middleware('auth', 'admin')->name('admin.managervip.add');
Route::post('/admin/managervip/remove',[ManagerVipController::class, 'remove'])->middleware('auth', 'admin')->name('admin.managervip.remove');
Route::post('/admin/managervip',[ManagerVipController::class, 'find'])->middleware('auth', 'admin')->name('admin.managervip.find');
// Gerenciar Equipe
Route::get('/admin/managerstaff',[ManagerStaffController::class, 'index'])->middleware('auth', 'admin')->name('admin.managerstaff');
Route::post('/admin/managerstaff/add',[ManagerStaffController::class, 'add'])->middleware('auth', 'admin')->name('admin.managerstaff.add');
Route::post('/admin/managerstaff/remove',[ManagerStaffController::class, 'remove'])->middleware('auth', 'admin')->name('admin.managerstaff.remove');
Route::post('/admin/managerstaff',[ManagerStaffController::class, 'find'])->middleware('auth', 'admin')->name('admin.managerstaff.find');
// Gerenciar Punições
Route::get('/admin/managerban',[ManagerBanController::class, 'index'])->middleware('auth', 'admin')->name('admin.managerban');
Route::post('/admin/managerban/add',[ManagerBanController::class, 'add'])->middleware('auth', 'admin')->name('admin.managerban.add');
Route::post('/admin/managerban/remove',[ManagerBanController::class, 'remove'])->middleware('auth', 'admin')->name('admin.managerban.remove');
Route::post('/admin/managerban',[ManagerBanController::class, 'find'])->middleware('auth', 'admin')->name('admin.managerban.find');
// Gerenciar Tickets.
Route::get('/admin/managertickets',[ManagerTicketController::class, 'index'])->middleware('auth', 'admin')->name('admin.managertickets');
Route::get('/admin/managertickets/view/{id}', [ManagerTicketController::class, 'view'])->middleware('auth', 'admin')->name('admin.managertickets.view');
Route::match(['post', 'get'], '/admin/managertickets/close/{id}',[ManagerTicketController::class, 'close'])->middleware('auth', 'admin')->name('admin.managertickets.close');
Route::match(['post', 'get'], '/admin/managertickets/open/{id}',[ManagerTicketController::class, 'open'])->middleware('auth', 'admin')->name('admin.managertickets.open');
Route::post('/admin/managertickets/reply', [ManagerTicketController::class, 'reply'])->middleware('auth', 'admin')->name('admin.managertickets.reply');
// Configurações do Painel
Route::get('/admin/configs',[ConfigController::class, 'index'])->middleware('auth', 'admin')->name('admin.config');
Route::post('/admin/configs/savegeneral',[ConfigController::class, 'saveGeneral'])->middleware('auth', 'admin')->name('admin.config.savegeneral');
Route::post('/admin/configs/saveaccount',[ConfigController::class, 'saveAccount'])->middleware('auth', 'admin')->name('admin.config.saveaccount');
Route::post('/admin/configs/savecolor',[ConfigController::class, 'saveColor'])->middleware('auth', 'admin')->name('admin.config.savecolor');
Route::post('/admin/configs/savecolorbg',[ConfigController::class, 'saveColorBg'])->middleware('auth', 'admin')->name('admin.config.savecolorbg');
Route::post('/admin/configs/savevip',[ConfigController::class, 'saveVip'])->middleware('auth', 'admin')->name('admin.config.savevip');
Route::post('/admin/configs/savestaff',[ConfigController::class, 'saveStaff'])->middleware('auth', 'admin')->name('admin.config.savestaff');
Route::post('/admin/configs/categorys/add',[ConfigController::class, 'addCategory'])->middleware('auth', 'admin')->name('admin.config.addcategory');
Route::post('/admin/configs/categorys/remove',[ConfigController::class, 'removeCategory'])->middleware('auth', 'admin')->name('admin.config.removecategory');

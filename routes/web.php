<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/dashboard');
})->name('welcome');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Authentication Routes
Auth::routes();

//User Profile
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
// Email verification Routes
Route::get('/email/send-verification', [VerificationController::class, 'send'])->name('auth.email.send.verification');
Route::get('email/verify', [VerificationController::class, 'verify'])->name('auth.email.verify');
//Reset Password Routes
Route::get('password/forget', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('auth.password.forget.form');
Route::post('password/forget', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('auth.password.forget');
Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('auth.password.reset.form');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('auth.password.reset');
// Google Login Routes
Route::get('redirect/{provider}', [SocialController::class, 'redirectToProvider'])->name('auth.login.provider.redirect');
Route::get('auth/{provider}/callback', [SocialController::class, 'callbackProvider'])->name('auth.login.provider.callback');


Route::group(['prefix' => 'setting', 'middleware' => 'role:admin'], function () {
    //Role And Permission Routes
    //Users Setting
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    //Roles Setting
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{role}/edit', [RoleController::class, 'update'])->name('roles.update');
    //End Of Role And Permission


    // General Settings

    Route::get('/general', [DeskController::class, 'setting'])->name('desks.setting');
});


//Desk Routes

Route::get('/desks/create', [DeskController::class, 'create'])->name('desks.create');
Route::post('/desks', [DeskController::class, 'store'])->name('desks.store');
Route::get('desks/select/{desk}', [DeskController::class, 'select'])->name('desks.select');
Route::post('desks/select/{desk}', [DeskController::class, 'update'])->name('desks.update');
Route::post('desks/send-request/{desk}', [DeskController::class, 'SendRequest'])->name('desks.Send.request');

//Project Routes

Route::get('/projects', \App\Http\Livewire\Project\Index::class)->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('project/{project}/board', [ProjectController::class, 'board'])->name('project.board');

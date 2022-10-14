<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
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

Route::prefix('password')->group(function () {
    Route::get('/forget', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('auth.password.forget.form');
    Route::post('/forget', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('auth.password.forget');
    Route::get('/reset', [ResetPasswordController::class, 'showResetForm'])->name('auth.password.reset.form');
    Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('auth.password.reset');
    Route::get('/change', [UserController::class, 'changePasswordForm'])->name('auth.password.change.form');
    Route::post('/change', [UserController::class, 'changePassword'])->name('auth.password.change');

});
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

    Route::prefix('roles')->name('roles')->controller(RoleController::class)->group(function () {
        Route::get('', [RoleController::class, 'index'])->name('.index');
        Route::post('', [RoleController::class, 'store'])->name('.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('.edit');
        Route::post('/{role}/edit', [RoleController::class, 'update'])->name('.update');
        Route::get('/{role}/delete', [RoleController::class, 'delete'])->name('.delete');
    });

    //End Of Role And Permission


    // General Settings

    Route::get('/general', [DeskController::class, 'setting'])->name('desks.setting');
});


//Desk Routes


Route::prefix('desks')->name('desks')->group(function () {
    Route::get('/create', [DeskController::class, 'create'])->name('.create');
    Route::post('', [DeskController::class, 'store'])->name('.store');
    Route::get('/select/{desk}', [DeskController::class, 'select'])->name('.select');
    Route::post('/select/{desk}', [DeskController::class, 'update'])->name('.update');
    Route::post('/send-request/{desk}', [DeskController::class, 'SendRequest'])->name('.Send.request');
    Route::get('/acceptRequest/{joinRequest}', [UserController::class, 'acceptRequest'])->name('.acceptRequest');
    Route::get('/deleteRequest/{joinRequest}', [UserController::class, 'deleteRequest'])->name('.deleteRequest');
    Route::get('/{desk}/user/{user}/delete', [DeskController::class, 'deleteUser'])->name('.user.delete');
    Route::get('/{desk}/delete', [DeskController::class, 'delete'])->name('.delete');
});


//Project Routes

Route::get('/projects', \App\Http\Livewire\Project\Index::class)->middleware('auth')->name('projects.index');

Route::prefix('projects')->controller(ProjectController::class)->group(function () {
    Route::get('/create', 'create')->name('projects.create');
    Route::post('/', 'store')->name('projects.store');
    Route::get('/{project}', 'show')->name('projects.show');
    Route::get('/{project}/board', 'board')->name('project.board');
    Route::post('/{project}/edit-users', 'updateUsers')->name('project.edit.user');
    Route::get('/{project}/delete', 'delete')->name('project.delete');
});


//Task routes

Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

//notes routes

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

//letter routes

Route::prefix('letters')->name('letters')->controller(LetterController::class)->group(function () {
    Route::get('/input', 'input')->name('.input');
    Route::get('/sent', 'sent')->name('.sent');
    Route::get('/paraph', 'paraph')->name('.paraph.page');
    Route::get('/archive', 'archive')->name('.archive');
    Route::get('/archive/{letter}', 'ToggleArchive')->name('.archive.add');
    Route::get('/{letter}', 'show')->name('.show');
    Route::post('{letter}/paraph', 'addParaph')->name('.paraph');
});


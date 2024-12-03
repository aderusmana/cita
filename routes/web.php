<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\IdeaApprovalController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\Master\ApproverController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\DepartmentController;
use App\Http\Controllers\Master\LevelController;
use App\Http\Controllers\Master\PermissionController;
use App\Http\Controllers\Master\PositionController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\SectionController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::get('/filter', [Dashboard::class, 'getLeaderboardData']);

    Route::get('/chartfilter', [Dashboard::class, 'getBarChart']);
    Route::get('/filterTarget', [Dashboard::class, 'getTargetData']);
    Route::get('/targets', [Dashboard::class, 'targetIndex'])->name('targets.index');
    Route::delete('/targets/{id}/delete', [Dashboard::class, 'targetDestroy'])->name('targets.destroy');
    Route::PUT('/targets/{id}/update', [Dashboard::class, 'targetUpdate'])->name('targets.update');
    Route::POST('/targets/store', [Dashboard::class, 'targetStore'])->name('targets.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [UserController::class, 'updateProfile'])->name('profile.updates');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('levels', LevelController::class);
    Route::resource('ideas', IdeaController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('approvers', ApproverController::class);

    Route::post('/ideas/{ideaId}/approve', [IdeaController::class, 'approveIdea'])->name('ideas.approve');
    Route::post('/ideas/{ideaId}/reject', [IdeaController::class, 'rejectIdea'])->name('ideas.reject');

    /* Upload IMage Idea */
    Route::post('/ideas/upload', [IdeaController::class, 'upload'])->name('ideas.upload');

    /* Idea Approval */
    Route::get('/idea-approvals', [IdeaApprovalController::class, 'index'])->name('ideas.approvals');

    /* Like Idea */
    Route::post('/ideas/{idea}/like', [IdeaController::class, 'toggleLike']);

    Route::get('/my-ideas', [IdeaController::class, 'myIdeas'])->name('ideas.my');
    Route::get('/my-likes-ideas', [IdeaController::class, 'my_ideaLikes'])->name('ideas.my_ideaLikes');
    Route::get('/xxxx', [IdeaController::class, 'getLikeCounts'])->name('getLikeCounts');    Route::post('/ideas/{idea}/like', [IdeaController::class, 'toggleLike']);
    // Route::get('/sse/like-updates', [IdeaController::class, 'streamUpdates']);

    Route::post('/notifications/mark-as-read', [IdeaController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/markAllAsRead', [IdeaController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/count', function () {
        return response()->json(['count' => auth()->user()->unreadNotifications->count()]);
    })->name('notifications.count');
    Route::delete('/notifications/clear', [IdeaController::class, 'clearAll'])->name('notifications.clear');

    Route::get('/ideas/search', [IdeaController::class, 'searchIdeas'])->name('ideas.search');

});


Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.give-permissions');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

});

Route::post('/ideas/upload', [IdeaController::class, 'upload'])->name('ideas.upload');



require __DIR__.'/auth.php';

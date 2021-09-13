<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::prefix('students')->group(function(){
    Route::get('show-students', [UserController::class, 'show'])->name('student.show');
    Route::get('detail/{id}', [UserController::class, 'detail'])->name('student.detail');
    Route::get('editInfo/{id}', [UserController::class, 'editInfo'])->name('editInfo');
    Route::post('editInfo/{id}', [UserController::class, 'postEditInfo']);
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('student.delete');
    Route::get('editPoint/{id}', [UserController::class, 'editPoint'])->name('student.editPoint');
    Route::post('editPoint/{id}', [UserController::class, 'postEditPoint']);
    Route::get('add', [UserController::class, 'add'])->name('student.add');
    Route::post('add', [UserController::class, 'postAdd'])->name('student.postadd');
    
});
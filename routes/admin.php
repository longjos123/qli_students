<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::prefix('students')->group(function () {
    Route::get('show-students', [UserController::class, 'show'])->middleware('auth')->name('student.show');
    Route::get('detail/{id}', [UserController::class, 'detail'])->middleware('auth')->name('student.detail');
    Route::get('editInfo/{id}', [UserController::class, 'editInfo'])->middleware('auth')->name('editInfo');
    Route::post('editInfo/{id}', [UserController::class, 'postEditInfo']);
    Route::get('delete/{id}', [UserController::class, 'delete'])->middleware('auth')->name('student.delete');
    Route::get('editPoint/{id}', [UserController::class, 'editPoint'])->middleware('auth')->name('student.editPoint');
    Route::post('editPoint/{id}', [UserController::class, 'postEditPoint']);
    Route::get('add', [UserController::class, 'view_add'])->middleware('auth')->name('student.view_add');
    Route::post('add', [UserController::class, 'postAdd'])->middleware('auth')->name('student.postadd');
});
<?php

use App\Controllers\AuthController;
use App\Controllers\ClassesController;
use App\Controllers\RegistrationController;
use App\Controllers\StudentController;
use App\Core\Route;

Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth', function () {

    //alunos
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/student/create', [StudentController::class, 'create']);
    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student/{id}/edit', [StudentController::class, 'edit']);
    Route::put('/student/{id}', [StudentController::class, 'update']);
    Route::delete('/student/{id}', [StudentController::class, 'delete']);
    
    //turmas
    Route::get('/classes', [ClassesController::class, 'index']);
    Route::get('/class/create', [ClassesController::class, 'create']);
    Route::post('/class', [ClassesController::class, 'store']);
    Route::get('/class/{id}/edit', [ClassesController::class, 'edit']);
    Route::get('/class/{id}/show', [ClassesController::class, 'show']);
    Route::put('/class/{id}', [ClassesController::class, 'update']);
    Route::delete('/class/{id}', [ClassesController::class, 'delete']);
    
    //matriculas
    Route::get('/register', [RegistrationController::class, 'create']);
    Route::post('/register', [RegistrationController::class, 'store']);
});

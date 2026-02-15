<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TachesController;
use App\Http\Controllers\AppController;

Route::get('/' , [AppController::class , 'dashbord'])->name('dashbord');

Route::prefix('taches')->group(function(){
   Route::get('/create' , [TachesController::class , 'create'])->name('taches.create');
   Route::post('/store' , [TachesController::class , 'store'])->name('taches.store');
   Route::get('/index', [TachesController::class , 'index'])->name('taches.index');
   //Route::get('/taches/{tache}/delete' , [TachesController::class, 'delete'])->name('taches.delete');
   Route::delete('/taches/{tache}' , [TachesController::class , 'destroy'])->name('taches.destroy');
   Route::get('/taches/{tache}/edit' , [TachesController::class , 'edit'])->name('taches.edit');
   Route::put('/taches/{tache}',[TachesController::class , 'update'])->name('taches.update');
});

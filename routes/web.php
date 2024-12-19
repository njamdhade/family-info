<?php

use Illuminate\Support\Facades\Route; 

use App\Http\Controllers\FamilyHeadController;
use App\Http\Controllers\FamilyMemberController;

// Route::redirect('/', '/family', 301);
Route::get('/', [FamilyHeadController::class, 'index'])->name('family.head.index');
Route::prefix('family')->group(function () {
    // Family head routes
    Route::get('create', [FamilyHeadController::class, 'create'])->name('family.head.create');
    Route::post('store', [FamilyHeadController::class, 'store'])->name('family.head.store');
    Route::get('edit/{id}', [FamilyHeadController::class, 'edit'])->name('family.head.edit');
    Route::post('update/{id}', [FamilyHeadController::class, 'update'])->name('family.head.update');
    Route::delete('delete/{id}', [FamilyHeadController::class, 'delete'])->name('family.head.delete');
    
    Route::get('show/{id}', [FamilyHeadController::class, 'show'])->name('family.head.show');

    Route::get("getcities",[FamilyHeadController::class,'getCities'])->name('family.getcities');

    // Family member routes
    Route::get('member/{familyHeadId}/create', [FamilyMemberController::class, 'create'])->name('family.member.create');
    Route::post('member/{familyHeadId}/store', [FamilyMemberController::class, 'store'])->name('family.member.store');
    Route::get('member/{familyHeadId}/edit/{id}', [FamilyMemberController::class, 'edit'])->name('family.member.edit');
});

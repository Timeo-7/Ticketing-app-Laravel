<?php
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/tickets', [TicketController::class, 'storeApi'])->name('api.tickets.storeApi');
    Route::put('/tickets/{id}', [TicketController::class, 'updateApi']);
    Route::put('/tickets/{id}/validate', [TicketController::class, 'validateApi']);
    Route::delete('/tickets/{id}', [TicketController::class, 'deleteApi']);
});

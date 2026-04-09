<?php
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/tickets', [TicketController::class, 'storeApi'])->name('api.tickets.storeApi');
    Route::put('/tickets/{id}', [TicketController::class, 'updateApi']);
});

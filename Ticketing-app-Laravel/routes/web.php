<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingsController;



Route::get('/', [ConnexionController::class, 'connexion'])->name('connexion.Connexion');
Route::get('/Connexion', [ConnexionController::class, 'connexion'])->name('connexion.Connexion');
Route::post('/Connexion/Store', [ConnexionController::class, 'Store'])->name('connexion.Store');


Route::get('/Forgotten', [ConnexionController::class, 'Forgotten'])->name('connexion.Forgotten');
Route::get('/Inscription', [ConnexionController::class, 'Inscription'])->name('connexion.Inscription');




    Route::get('/Dashboard/{id}', [DashboardController::class, 'Dashboard'])->name('dashboard.Dashboard');
    Route::get('/Client-List', [ClientController::class, 'ClientList'])->name('clients.ClientList');


    Route::get('/Ticket-List/{id}', [TicketController::class, 'TicketList'])->name('tickets.TicketList');
    Route::get('/Ticket/{id}', [TicketController::class, 'Ticket'])->name('tickets.Ticket');
    Route::get('/Ticket-Form/{id}', [TicketController::class, 'TicketForm'])->name('tickets.TicketForm');
    Route::post('/Tickets/Store/{id}', [TicketController::class, 'Store'])->name('tickets.Store');
    Route::delete('/Tickets/Delete', [TicketController::class, 'Delete'])->name('tickets.Delete');
    Route::get('/tickets/{id}/Edit', [TicketController::class, 'Edit'])->name('tickets.Edit');
    Route::put('/tickets/{id}/Update', [TicketController::class, 'Update'])->name('tickets.Update');
    Route::put('/tickets/{id}/Validate', [TicketController::class, 'Validate'])->name('tickets.Validate');

    Route::get('/Project-List/{id}', [ProjectController::class, 'ProjectList'])->name('projects.ProjectList');
    Route::get('/Project/{id}', [ProjectController::class, 'Project'])->name('projects.Project');
    Route::get('/Project-Form/{id}', [ProjectController::class, 'ProjectForm'])->name('projects.ProjectForm');
    Route::post('/Project/Store/{id}', [ProjectController::class, 'Store'])->name('projects.Store');
    Route::delete('/Project/Delete', [ProjectController::class, 'Delete'])->name('projects.Delete');
    Route::get('/Project/{id}/Edit', [ProjectController::class, 'Edit'])->name('projects.Edit');
    Route::post('/Project/{id}/Update', [ProjectController::class, 'Update'])->name('projects.Update');
    Route::post('/Project/{id}/Validate', [ProjectController::class, 'Validate'])->name('projects.Validate');


    Route::get('/Profil', [ProfilController::class, 'Profil'])->name('profil.Profil');
    Route::get('/Settings', [SettingsController::class, 'Settings'])->name('settings.Settings');




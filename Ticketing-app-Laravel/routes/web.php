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




    Route::get('/Dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard.Dashboard');
    Route::get('/Client-List', [ClientController::class, 'ClientList'])->name('clients.ClientList');


    Route::get('/Ticket-List', [TicketController::class, 'TicketList'])->name('tickets.TicketList');
    Route::get('/Ticket', [TicketController::class, 'Ticket'])->name('tickets.Ticket');
    Route::get('/Ticket-Form', [TicketController::class, 'TicketForm'])->name('tickets.TicketForm');

    Route::get('/Project-List', [ProjectController::class, 'ProjectList'])->name('projects.ProjectList');
    Route::get('/Project', [ProjectController::class, 'Project'])->name('projects.Project');
    Route::get('/Project-Form', [ProjectController::class, 'ProjectForm'])->name('projects.ProjectForm');


    Route::get('/Profil', [ProfilController::class, 'Profil'])->name('profil.Profil');
    Route::get('/Settings', [SettingsController::class, 'Settings'])->name('settings.Settings');




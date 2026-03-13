<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                'user_id' => 1,
                'project_id' => 1,
                'title' => 'Problème de connexion utilisateur',
                'client' => 'Client A',
                'description' => 'L’utilisateur ne peut pas se connecter au portail.',
                'project' => 'Projet Alpha',
                'statut' => '⏳',
                'facturable' => '🪙',
            ],
            [
                'user_id' => 2,
                'project_id' => 2,
                'title' => 'Erreur lors du paiement',
                'client' => 'Client B',
                'description' => 'Le paiement échoue avec un code 500.',
                'project' => 'Projet Beta',
                'statut' => '❌',
                'facturable' => '_',
            ],
            [
                'user_id' => 3,
                'project_id' => 3,
                'title' => 'Demande de remboursement',
                'client' => 'Client C',
                'description' => 'Le client demande un remboursement partiel.',
                'project' => 'Projet Gamma',
                'statut' => '⏳',
                'facturable' => '🪙',
            ],
            [
                'user_id' => 4,
                'project_id' => 1,
                'title' => 'Bug affichage tableau de bord',
                'client' => 'Client D',
                'description' => 'Les graphiques ne s’affichent pas correctement.',
                'project' => 'Projet Alpha',
                'statut' => '⏳',
                'facturable' => '_',
            ],
            [
                'user_id' => 5,
                'project_id' => 2,
                'title' => 'Mot de passe oublié',
                'client' => 'Client E',
                'description' => 'L’utilisateur ne reçoit pas l’email de réinitialisation.',
                'project' => 'Projet Beta',
                'statut' => '✅',
                
                'facturable' => '🪙',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
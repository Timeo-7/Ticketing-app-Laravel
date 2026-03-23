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
                'user_id' => 11,
                'project_id' => 1,
                'title' => 'Problème de connexion utilisateur',
                'client' => 'Client A',
                'description' => 'L’utilisateur ne peut pas se connecter au portail.',
                'project' => 'Plateforme e-commerce',
                'statut' => "⌛",
                'facturable' => '🪙',
            ],
            [
                'user_id' => 2,
                'project_id' => 1,
                'title' => 'Erreur lors du paiement',
                'client' => 'Client B',
                'description' => 'Le paiement échoue avec un code 500.',
                'project' => 'Plateforme e-commerce',
                'statut' => "✅",
                'facturable' => '_',
            ],
            [
                'user_id' => 3,
                'project_id' => 1,
                'title' => 'Demande de remboursement',
                'client' => 'Client C',
                'description' => 'Le client demande un remboursement partiel.',
                'project' => 'Plateforme e-commerce',
                'statut' => "⌛",
                'facturable' => '🪙',
            ],
            [
                'user_id' => 4,
                'project_id' => 1,
                'title' => 'Bug affichage tableau de bord',
                'client' => 'Client D',
                'description' => 'Les graphiques ne s’affichent pas correctement.',
                'project' => 'Plateforme e-commerce',
                'statut' => "⌛",
                'facturable' => '_',
            ],
            [
                'user_id' => 5,
                'project_id' => 1,
                'title' => 'Mot de passe oublié',
                'client' => 'Client E',
                'description' => 'L’utilisateur ne reçoit pas l’email de réinitialisation.',
                'project' => 'Plateforme e-commerce',
                'statut' => "✅",
                
                'facturable' => '🪙',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
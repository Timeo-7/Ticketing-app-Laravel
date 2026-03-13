<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Plateforme e-commerce',
                'client' => 'Client A',
                'description' => 'Développement d’une plateforme de vente en ligne.',
                'ticketNumber' => 12,
                'workingTickets' => 5,
                'waitingTickets' => 3,
                'contract' => 'Premium',
                'user_id' => 1,
            ],
            [
                'title' => 'Application mobile bancaire',
                'client' => 'Client B',
                'description' => 'Maintenance et amélioration de l’application bancaire.',
                'ticketNumber' => 8,
                'workingTickets' => 2,
                'waitingTickets' => 4,
                'contract' => 'Standard',
                'user_id' => 2,
            ],
            [
                'title' => 'Site vitrine entreprise',
                'client' => 'Client C',
                'description' => 'Création d’un site vitrine pour une PME.',
                'ticketNumber' => 5,
                'workingTickets' => 1,
                'waitingTickets' => 2,
                'contract' => 'Basic',
                'user_id' => 1,
            ],
            [
                'title' => 'Outil interne de gestion',
                'client' => 'Client D',
                'description' => 'Développement d’un outil interne pour la gestion des stocks.',
                'ticketNumber' => 15,
                'workingTickets' => 6,
                'waitingTickets' => 5,
                'contract' => 'Premium',
                'user_id' => 3,
            ],
            [
                'title' => 'Refonte site web',
                'client' => 'Client E',
                'description' => 'Refonte complète du site web existant.',
                'ticketNumber' => 9,
                'workingTickets' => 3,
                'waitingTickets' => 2,
                'contract' => 'Standard',
                'user_id' => 2,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
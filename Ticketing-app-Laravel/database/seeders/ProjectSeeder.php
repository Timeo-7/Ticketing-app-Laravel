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
                'ticketNumber' => 0,
                'workingTickets' => 0,
                'completeTickets' => 0,
                'contract' => 'Premium',
                'user_id' => 11,
            ],
            [
                'title' => 'Application mobile bancaire',
                'client' => 'Client B',
                'description' => 'Maintenance et amélioration de l’application bancaire.',
                'ticketNumber' => 0,
                'workingTickets' => 0,
                'completeTickets' => 0,
                'contract' => 'Standard',
                'user_id' => 2,
            ],
            [
                'title' => 'Site vitrine entreprise',
                'client' => 'Client C',
                'description' => 'Création d’un site vitrine pour une PME.',
                'ticketNumber' => 0,
                'workingTickets' => 0,
                'completeTickets' => 0,
                'contract' => 'Basic',
                'user_id' => 11,
            ],
            [
                'title' => 'Outil interne de gestion',
                'client' => 'Client D',
                'description' => 'Développement d’un outil interne pour la gestion des stocks.',
                'ticketNumber' => 0,
                'workingTickets' => 0,
                'completeTickets' => 0,
                'contract' => 'Premium',
                'user_id' => 3,
            ],
            [
                'title' => 'Refonte site web',
                'client' => 'Client E',
                'description' => 'Refonte complète du site web existant.',
                'ticketNumber' => 0,
                'workingTickets' => 0,
                'completeTickets' => 0,
                'contract' => 'Standard',
                'user_id' => 2,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
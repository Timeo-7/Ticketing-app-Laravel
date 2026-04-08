<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'id' => 1,
                'name' => 'Client A',
                'user_id' => 11,
            ],
            [
                'id' => 2,
                'name' => 'Client B',
                'user_id' => 11,
            ],
            [
                'id' => 3,
                'name' => 'Client C',
                'user_id' => 2,
            ],
            [
                'id' => 4,
                'name' => 'Client D',
                'user_id' => 3,
            ],
            [
                'id' => 5,
                'name' => 'Client E',
                'user_id' => 11,
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
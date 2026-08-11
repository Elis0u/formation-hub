<?php

namespace Database\Seeders;

use App\Models\FormationSession;
use App\Models\User;
use Illuminate\Database\Seeder;

class FormationSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $trainers = User::where('role', 'trainer')->get();

        FormationSession::factory()
            ->count(10)
            ->recycle($trainers)
            ->create();
    }
}

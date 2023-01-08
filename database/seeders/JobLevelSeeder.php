<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_levels')->insert([
            [
                'level' => 'Internship'
            ],
            [
                'level' => 'Entry level'
            ],
            [
                'level' => 'Associate'
            ],
            [
                'level' => 'Mid-senior level'
            ],
            [
                'level' => 'Director'
            ],
            [
                'level' => 'Executive'
            ],
        ]);
    }
}

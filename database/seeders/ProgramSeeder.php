<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program')->insert([
            [
                'id' => 1,
                'name' => 'task',
                'path' => 'task',
                'parent_id' => NULL,
            ], [
                'id' => 2,
                'name' => 'bug單',
                'path' => 'bugTask',
                'parent_id' => 1,
            ], [
                'id' => 3,
                'name' => 'feature單',
                'path' => 'featureTask',
                'parent_id' => 1,
            ], [
                'id' => 4,
                'name' => 'test單',
                'path' => 'testTask',
                'parent_id' => 1,
            ], [
                'id' => 5,
                'name' => 'super',
                'path' => 'super',
                'parent_id' => NULL,
            ], [
                'id' => 6,
                'name' => 'user',
                'path' => 'user',
                'parent_id' => 5,
            ],
        ]);
    }
}

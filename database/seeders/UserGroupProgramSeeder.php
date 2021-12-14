<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_group_program')->insert([
            [
                'user_group_id' => 2,
                'program_id' => 2,
                'create' => 1,
                'update' => 1,
                'read' => 1,
                'delete' => 1,
                'state' => 1,
            ],
            [
                'user_group_id' => 3,
                'program_id' => 2,
                'create' => 0,
                'update' => 1,
                'read' => 1,
                'delete' => 0,
                'state' => 1,
            ], [
                'user_group_id' => 4,
                'program_id' => 3,
                'create' => 1,
                'update' => 1,
                'read' => 1,
                'delete' => 1,
                'state' => 1,
            ],
            [
                'user_group_id' => 3,
                'program_id' => 3,
                'create' => 0,
                'update' => 1,
                'read' => 1,
                'delete' => 0,
                'state' => 1,
            ], [
                'user_group_id' => 2,
                'program_id' => 4,
                'create' => 1,
                'update' => 1,
                'read' => 1,
                'delete' => 1,
                'state' => 1,
            ],
        ]);
    }
}

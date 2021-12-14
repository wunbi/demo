<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserGroup::create([
            'group_name' => 'superAdmin',
        ]);


        UserGroup::create([
            'group_name' => 'qa',
        ]);


        UserGroup::create([
            'group_name' => 'rd',
        ]);


        UserGroup::create([
            'group_name' => 'pm',
        ]);
    }
}

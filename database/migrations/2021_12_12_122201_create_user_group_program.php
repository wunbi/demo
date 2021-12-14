<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_program', function (Blueprint $table) {
            $table->id();
            $table->integer('user_group_id', false, true);
            $table->integer('program_id', false, true);
            $table->boolean('create');
            $table->boolean('update');
            $table->boolean('read');
            $table->boolean('delete');
            $table->boolean('state');
            $table->unique(['user_group_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_group_program');
    }
}

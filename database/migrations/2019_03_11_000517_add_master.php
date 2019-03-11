<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $master = \App\Models\User::create([
            'name'      => 'Mestre',
            'email'     => 'master@email.com',
            'password'  => bcrypt('123123'),
        ]);

        $master->assignRole('master');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(config('app.env') == 'local'){
            $password_superadmin = '123123';
            $password_admin = '123123';
        }else{
            $password_superadmin = '#*65<WvM';
            $password_admin = 'qXm4rT%A';
        }

        $super_admin =  User::create([
            'name'      => 'SuperAdmin',
            'email'     => 'super_admin@email.com',
            'password'  => bcrypt($password_superadmin)
        ]);

        $super_admin->assignRole('super_admin');

        $admin =  User::create([
            'name'      => 'Admin',
            'email'     => 'admin@email.com',
            'password'  => bcrypt($password_admin)
        ]);

        $admin->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

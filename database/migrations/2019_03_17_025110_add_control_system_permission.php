<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddControlSystemPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $super_admin = \Spatie\Permission\Models\Role::find(1);

        $permission_system = \Spatie\Permission\Models\Permission::create([
            'name'    => 'control_system',
        ]);

        $super_admin->givePermissionTo($permission_system);

        $admin = \Spatie\Permission\Models\Role::find(2);


        $admin->givePermissionTo($permission_system);
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

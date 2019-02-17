<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $super_admin = Role::create(['name' => 'super_admin']);

        $permission_logs = Permission::create([
              'name'    => 'view_activitylog',
        ]);

        $permission_telescope = Permission::create([
            'name'    => 'view_telescope'
        ]);

        $permission_users = Permission::create([
            'name'    => 'view_users'
        ]);

        $super_admin->givePermissionTo($permission_logs, $permission_telescope, $permission_users);

        $admin = Role::create(['name'   => 'admin']);

        $admin->syncPermissions($permission_users);
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

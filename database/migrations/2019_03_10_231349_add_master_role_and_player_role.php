<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddMasterRoleAndPlayerRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $master = Role::create(['name' => 'master']);

        //permissao para controlar npcs
        $permission_npc = Permission::create([
            'name'    => 'control_npc',
        ]);

        //permissao para controlar mesas de rpg
        $permission_rpg = Permission::create([
            'name'    => 'control_rpg',
        ]);

        //permissao para controlar players
        $permission_player = Permission::create([
            'name'    => 'control_players',
        ]);

        //permissao para ver as fichas dos jogadores
        $permission_card = Permission::create([
            'name'    => 'view_card'
        ]);

        $master->givePermissionTo($permission_card, $permission_npc, $permission_rpg, $permission_player);

        $admin = Role::create(['name'   => 'player']);

        $admin->syncPermissions($permission_card);
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

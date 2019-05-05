<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Board.Rpg.{rpg_id}', function ($user, $rpg_id) {

    $check_master = \App\Models\RpgUser::where('user_id', $user->id)->where('rpg_id', $rpg_id)->first();
    $check_player = \App\Models\Card::where('model_id', $user->id)->where('rpg_id', $rpg_id)->first();

    if($check_master || $check_player){
        return ['id' => $user->id, 'name' => $user->name];
    }
});

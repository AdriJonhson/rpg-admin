<?php

namespace App\Http\Controllers;

use App\Events\StatusEvents;
use App\Models\Card;
use App\Models\Rpg;
use App\Models\Status;
use App\Models\StatusPlayer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    public function getStatusCard(Request $request, Card $card)
    {
        $status = $card->status;

        return DataTables::of($status)->make(true);
    }

    public function addStatusToPlayer(Request $request, Card $card)
    {
        try{
            $content = [
                'hp'            => $request->hp,
                'mp'            => $request->mp,
                'skill'         => $request->skill,
                'force'         => $request->force,
                'constitution'  => $request->constitution,
                'sapience'      => $request->sapience,
                'charisma'      => $request->charisma,
                'intelligence'  => $request->intelligence
            ];

            $status = Status::create([
                'rpg_id'    => $card->rpg_id,
                'name'      => $request->name,
                'duration'  => $request->duration,
                'active'    => $request->active,
                'content'   => json_encode($content)
            ]);

            StatusPlayer::create([
                'card_id'   => $card->id,
                'status_id' => $status->id
            ]);

            $rpg = Rpg::find($card->rpg_id);

            event(new StatusEvents($rpg, $card));

            return response()->json(['message'  => 'Status Atualizados com sucesso'], 202);
        }catch(\Exception $ex){
            return response()->json(['message'  => 'Algo Deu Errado! Tente Novamente.'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rpg;
use App\Models\RpgPlayer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class RpgController extends Controller
{
    public function index(Request $request)
    {
        $vars = [];

        if($request->wantsJson()){

            if($request->user()->hasRole('player')){
                $rpgs = new Collection();

                $playerRpgs = RpgPlayer::with('rpg')->where('model_id', $request->user()->id)->get();

                foreach($playerRpgs as $playerRpg){
                    $rpgs->push($playerRpg->rpg);
                }

            }else{
                $rpgs = Rpg::query();
            }

            return DataTables::of($rpgs)->make(true);
        }

        if($request->user()->hasRole('master')){
            $vars['players'] = self::getPlayers();
        }


        return view('admin.rpgs.index')->with($vars);
    }

    public function store(Request $request)
    {
        $rpg = Rpg::create($request->all());

        return redirect()->back()->withSuccess('Aventura criada com sucesso!');
    }

    public function update(Request $request, Rpg $rpg)
    {
        $rpg->update($request->all());

        return redirect()->back()->withSuccess('Dados da aventura atualizados com sucesso!');
    }

    public function delete(Request $request)
    {
        $rpg = Rpg::destroy($request->id);

        return redirect()->back()->withSuccess('Aventura removida!');
    }

    public function addPlayer(Request $request, Rpg $rpg)
    {
       $addPlayer = $rpg->players()->syncWithoutDetaching($request->player);

       if(count($addPlayer['attached']) == 0){
           return redirect()->back()->withInfo('O jogador já esta participando dessa aventura!');
       }

        return redirect()->back()->withSuccess('Player adicionado com sucesso!');
    }

    private function getPlayers()
    {
        $users = User::role('player' )->select('id', 'name')->get();

        return $users;
    }
}

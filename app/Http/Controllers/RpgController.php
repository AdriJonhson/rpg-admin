<?php

namespace App\Http\Controllers;

use App\Models\Rpg;
use App\Models\RpgPlayer;
use App\Models\RpgUser;
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
            $user = $request->user();

            $rpgs = new Collection();

            $playerRpgs = RpgPlayer::with('rpg')->where('model_id', $user->id)->get();

            foreach($playerRpgs as $playerRpg){
                $rpgs->push($playerRpg->rpg);
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
        $user = $request->user();

        $rpg = Rpg::create($request->all());

        RpgUser::create([
            'user_id'   => $user->id,
            'rpg_id'    => $rpg->id
        ]);

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

    public function startAdventure(Request $request, Rpg $rpg)
    {
        config(['adminlte.collapse_sidebar' => true]);

        $cards =  $rpg->cards;

        $controlRpg = $request->user()->can('control_rpg');

        return view('admin.rpgs.start', compact('rpg', 'cards', 'controlRpg'));
    }

    public function getMyRpgs(Request $request)
    {
        if($request->wantsJson()){
            $user = $request->user();

            $rpgs = $user->myRpgs;

            return DataTables::of($rpgs)->make(true);
        }

        return view('admin.rpgs.my-rpgs');
    }
}

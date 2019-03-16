<?php

namespace App\Http\Controllers;

use App\Models\Rpg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class RpgController extends Controller
{
    public function index(Request $request)
    {
        if($request->wantsJson()){
            $rpgs = Rpg::query();

            return DataTables::of($rpgs)->make(true);
        }


        return view('admin.rpgs.index');
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
}

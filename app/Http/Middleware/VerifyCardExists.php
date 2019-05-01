<?php

namespace App\Http\Middleware;

use App\Models\Rpg;
use Closure;

class VerifyCardExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = $request->user();

        if(!$user->myRpgs()->where('slug', $request->route('rpg')->slug)->first()){
            $rpg = $request->route('rpg');
            $verifyExistsCard = $user->cards()->where('rpg_id', $rpg->id)->get();

            if(count($verifyExistsCard) <= 0){
                return redirect()->route('card.create', $request->route('rpg')->slug);
            }
        }

        return $next($request);
    }
}

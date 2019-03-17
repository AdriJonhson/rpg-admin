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
        if(!$request->user()->hasRole(['master', 'super_admin', 'admin'])){

            $rpg = $request->route('rpg');
            $user = $request->user();
            $verifyExistsCard = $user->cards()->where('rpg_id', $rpg->id)->get();

            if(count($verifyExistsCard) <= 0){
                return redirect()->route('card.create', $request->route('rpg')->slug);
            }
        }

        return $next($request);
    }
}

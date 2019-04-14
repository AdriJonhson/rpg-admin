<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Rpg;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{
    public function create(Request $request, Rpg $rpg)
    {
        config(['adminlte.collapse_sidebar' => true]);

        $races = Card::getRaces();
        $classes = Card::getClasses();

        return view('admin.cards.create', compact('races', 'classes', 'rpg'));
    }

    public function store(Request $request, Rpg $rpg)
    {
        $user = $request->user();

        $verifyCardExist = $user->cards()->where('rpg_id', $rpg->id)->get();

        if(count($verifyCardExist) > 0){
            $request->session()->flash("Você já possui uma ficha criada nesse RPG!");
            return response()->json(['message' => "Você já possui uma ficha criada nesse RPG!"], 400);
        }

        $attributes = $this->calculateAttributesByClassAndSubClass($request);

        $avatar_url = self::uploadImage($request);

        $dataCard = [
            'attributes'    => json_encode($attributes),
            'name'          => $request->name,
            'class'         => $request->class,
            'race'          => $request->race,
            'sub_race'      => $request->sub_race != null ? $request->sub_race : null,
            'health_point'  => $request->hp,
            'mana_point'    => $request->mp,
            'current_life'    => $request->hp,
            'current_mana'    => $request->mp,
            'constitution'  => $request->constitution,
            'description'   => $request->personalidade,
            'rpg_id'        => $rpg->id,
            'avatar_url'    => $avatar_url
        ];

        $card = $user->cards()->create($dataCard);

        if(!$card){
            return response()->json(['message' => "Algo deu errado. Tente Novamente!"], 400);
        }

        return response()->json(['message' => 'Seja Bem-Vindo a essa nova aventura! Divirta-se!!!'], 202);
    }

    private function calculateAttributesByClassAndSubClass($request)
    {
        $race = $request->race;
        $subRace = $request->sub_race;

        $calcSkill           = 0;
        $calcForce           = 0;
        $calcConstitution    = 0;
        $calcSapience        = 0;
        $calcCharisma        = 0;
        $calcIntelligence    = 0;

        $force          = $request->force;
        $skill          = $request->skill;
        $constitution   = $request->constitution;
        $sapience       = $request->sapience;
        $charisma       = $request->charisma;
        $intelligence   = $request->intelligence;

        if($race == "Humano"){

            $calcForce = $force + 1;
            $calcSkill = $skill + 1;
            $calcConstitution = $constitution + 1;
            $calcSapience = $sapience + 1;
            $calcCharisma = $charisma + 1;
            $calcIntelligence = $intelligence + 1;

        }else if($race == "Draconato"){

            $calcForce = $force + 1;
            $calcCharisma = $charisma + 1;

        }else if($race == "Meio-Orc"){

            $calcForce = $force + 2;
            $calcConstitution = $constitution + 1;

        }else if($race == "Elfo"){

            $calcSkill = $skill + 2;

        }else if($race == "Halfling"){

            $calcSkill = $skill + 2;

        }else if($race == "Anão"){

            $calcConstitution = $constitution + 2;

        }else if($race == "Gnomo"){

            $calcIntelligence = $intelligence + 2;

        }else if($race == "Tiefling"){

            $calcIntelligence = $intelligence + 1;
            $calcCharisma = $charisma + 2;

        }else if($race == "Meio-Elfo"){
            $calcCharisma = $charisma + 2;
        }

        if($subRace != null){
            if($subRace == "Anão da Montanha"){

                $calcForce += 2;

            }else if($subRace == "Gnomo da Floresta"){

                $calcSkill +=  2;

            }else if($subRace == "Halfling Robusto"){

                $calcConstitution +=  1;

            }else if($subRace == "Gnomo Das Rochas"){

                $calcConstitution += 1;

            }else if($subRace == "Alto Elfo"){

                $calcIntelligence += 1;

            }else if($subRace == "Anão Da Colina"){

                $calcSapience += 1;

            }else if($subRace == "Elfo Da Floresta"){

                $calcSapience += 1;

            }else if($race == "Meio-Elfo"){

                $calcCharisma += 2;

            }else if($subRace == "Drow"){

                $calcCharisma += 1;

            }else if($subRace == "Pés-Leves"){

                $calcCharisma += 1;

            }
        }

        $attributes = [
            'skill'         =>  $calcSkill != 0 ? $calcSkill : $skill,
            'force'         =>  $calcForce != 0 ? $calcForce : $force,
            'constitution'  =>  $calcConstitution != 0 ? $calcConstitution : $constitution,
            'sapience'      =>  $calcSapience != 0 ? $calcSapience : $sapience,
            'charisma'      =>  $calcCharisma != 0 ? $calcCharisma : $charisma,
            'intelligence'  =>  $calcIntelligence != 0 ? $calcIntelligence : $intelligence,
        ];

        return $this->formAttributesJson($attributes);
    }

    private function formAttributesJson($attributes)
    {
        $json = [];

        foreach($attributes as $attribute => $value){

            $json[$attribute] = [
                'value'         => (int)$value,
                'modifier'      => self::calculateModifier($value)
            ];
        }

        return $json;
    }

    private static function calculateModifier($value)
    {
        $modifer = 0;

        if($value == 8 || $value == 9){
            $modifer = -1;

        }else if($value == 10 || $value == 11){
            $modifer = 0;

        }else if($value == 12 || $value == 13){
            $modifer = 1;

        }else if($value == 14 || $value == 15){
            $modifer = 2;

        }else if($value == 16 || $value == 17){
            $modifer = 3;

        }else if($value == 18 || $value == 19){
            $modifer = 4;

        }else if($value == 20 || $value == 21){
            $modifer = 5;

        }else if($value == 22 || $value == 23){
            $modifer = 6;

        }else if($value == 24 || $value == 25){
            $modifer = 7;

        }else if($value == 26 || $value == 27){
            $modifer = 8;

        }else if($value == 28 || $value == 29){
            $modifer = 9;

        }else if($value == 30){
            $modifer = 10;
        }

        return $modifer;
    }

    private static function uploadImage($request)
    {
        if($request->hasFile('perfil') && $request->file('perfil')->isValid()){

            $name = uniqid(date('HisYmd'));
            $extension = $request->perfil->extension();

            $filename = "{$name}.{$extension}";

            $upload = $request->perfil->storeAs('medias', $filename);

            if($upload){
                return "/storage/medias/{$filename}";
            }

            return null;
        }

        return null;
    }
}

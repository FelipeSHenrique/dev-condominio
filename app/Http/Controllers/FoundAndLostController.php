<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FoundAndLost;

class FoundAndLostController extends Controller
{
    public function getAll() {
        $array = ['error' => ''];

        // retorna todos os achos e perdidos
        $lost = FoundAndLost::where('status', 'LOST')
        ->orderBy('datecreated', 'DESC')
        ->orderBy('id', 'DESC')
        ->get();

        // retorna todos os itens recuperados
        $recovered = FoundAndLost::where('status', 'RECOVERED')
        ->orderBy('datecreated', 'DESC')
        ->orderBy('id', 'DESC')
        ->get();

        // Formatar data e url de foto
        foreach ($lost as $lostkey => $lostValue) {
            $lost[$lostkey]['datecreated'] = date('d/m/y', strtotime($lostValue['datecreated']));
            $lost[$lostkey]['photo'] = asset('storage/'.$lostValue['photo']);
        }
        // Formatar data e url de foto
        foreach ($recovered as $recoveredkey => $recoveredValue) {
            $recovered[$recoveredkey]['datecreated'] = date('d/m/y', strtotime($recoveredValue['datecreated']));
            $recovered[$recoveredkey]['photo'] = asset('storage/'.$recoveredValue['photo']);
        }

        $array['lost'] = $lost;
        $array['recovered'] = $recovered;

        return $array;
    }
}

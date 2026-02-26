<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoriqueStagRequest;
use App\Models\AffectionAgent;
use App\Models\historique_stageAgent;
use Illuminate\Http\Request;

class HistroriqueStageController extends Controller
{
    //re


    public function addHsitorique(HistoriqueStagRequest $request){
          //dd($request);
         $affect=AffectionAgent::find($request->affectation_id);
        if(!$affect){
            return back()->with('error','Affectation introuvable');
        }
         
        
         $historique=new historique_stageAgent();
         $historique->commentaire=$request->commentaire;
         $historique->moyenne=$request->moyenne ?:0;
         $historique->affection_agent_id=$affect->id;
        $historique->date_de_fin=$request->date_fin;
        $historique->mention=$request->mention ?:"R.A.S";
         $affect->status="Terminé";
         $affect->save();
         $historique->save();
         return back()->with('success','Stage validé avec success enrégstré dans l historique');

    }
}

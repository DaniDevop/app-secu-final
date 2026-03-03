<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoriqueStagRequest;
use App\Models\AffectionAgent;
use App\Models\historique_stageAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HistroriqueStageController extends Controller
{
    //re
public function index()
{
    
 try {
        $historiques = DB::table('historique_stage_agents as h')
            ->leftJoin('affection_agents as a', 'h.affection_agent_id', '=', 'a.id')
            ->leftJoin('agent_stagiares as agent', 'a.agent_stagiare_id', '=', 'agent.id')
            ->leftJoin('ecole_stages as e', 'a.ecole_stage_id', '=', 'e.id')
            ->select(
                'h.id',
                'h.moyenne',
                'h.mention',
                'h.commentaire',
                'h.date_de_fin',
                'h.created_at',
                'agent.matricule as agent_matricule',
                'agent.name as agent_nom',
                'agent.prenom as agent_prenom',
                'agent.grade as agent_grade',
                'e.nom_ecole as ecole_nom',
                'e.adresse as ecole_adresse',
                'a.date_debut as affection_date_debut',
                'a.date_fin as affection_date_fin',
                'a.type_formations'
            )
            ->orderBy('h.date_de_fin', 'desc')
            ->get();

          //dd($historiques);
        
        return view('users.historique.index', compact('historiques'));
        
    } catch (\Exception $e) {
        Log::error('Erreur historique: ' . $e->getMessage());
        return back()->with('error', 'Une erreur est survenue lors du chargement de l\'historique');
    }

}

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


    public function editHistorique($id){
        $affect=AffectionAgent::find($id);
        if(!$affect){
            return back()->with('error','Affectation introuvable');
        }
         $agentAll=DB::table('agent_stagiares')->get();
         $ecoleStageAll=DB::table('ecole_stages')->get();
         $historique=historique_stageAgent::where('affection_agent_id',$id)->first(); 
     //  dd($historique->affection);
         return view('users.historique.edit',compact('affect','agentAll','ecoleStageAll','historique'));

    }
}

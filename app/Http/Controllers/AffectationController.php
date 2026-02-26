<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAffectationRequest;
use App\Http\Requests\EditAffectationRequest;
use App\Http\Requests\HistoriqueStagRequest;
use App\Models\AffectationAgent;
use App\Models\AffectionAgent;
use App\Models\AgentStagiare;
use App\Models\EcoleStage;
use App\Models\historique_stageAgent;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function index(){
     
    $affectations=AffectionAgent::with('agent','ecoles')->get();
    $agentAll=AgentStagiare::all();
    $ecoleStageAll=EcoleStage::all();
    
    return view('users.affectation.index',compact('affectations','agentAll','ecoleStageAll'));
    }



     public function editAffectation($id){

       $affect=AffectionAgent::find($id);
       if(!$affect){
        //toastr()->warning('Information introuvable !');
        return back();
       }
        $agentAll=AgentStagiare::all();
    $ecoleStageAll=EcoleStage::all();

       return view('users.affectation.edit',compact('affect','agentAll','ecoleStageAll'));
     }

    public function addAffectation(AddAffectationRequest $request)
{
    
    $validated = $request->validated();
    $affectation = new AffectionAgent();
    $affectation->agent_stagiare_id = $validated['agent_stagiare_id'];
    $affectation->ecole_stage_id    = $validated['ecole_stage_id'];
    $affectation->date_debut        = $validated['date_debut'];
    $affectation->date_fin          = $validated['date_fin'];
    $affectation->type_formations   = $validated['type_formations'];
    $affectation->status   = "En-cours";
    $affectation->save();

    return back()->with('success', 'L’affectation a été ajoutée avec succès.');
}





     public function EditAffectationAgent(EditAffectationRequest $request){
          //dd($request->all());
      
          
      $affectation=AffectionAgent::find($request->affectation_id);
      if(!$affectation){
        
        return back()->with('error','Affectation introuvable !');
      }
      
      $affectation->agent_stagiare_id=$request->agent_stagiare_id;
    $affectation->ecole_stage_id=$request->ecole_stage_id;
    $affectation->date_debut=$request->date_debut;
    $affectation->type_formations=$request->type_formations;
    $affectation->date_fin=$request->date_fin;
     

      $affectation->save();
      return back()->with('success','Affectation modifiée avec succès !');

    }

    public function FormationFinis(HistoriqueStagRequest $request)
    {
       
        $affectation = AffectionAgent::find($request->affectation_id);
        if (!$affectation) {
            return back()->with('error', 'Affectation introuvable !');
        }
        $historique = new historique_stageAgent();
        $historique->affectation_id = $request->affectation_id;
        $historique->moyenne = $request->moyenne ? :0;
         $historique->commentaire = $request->commentaire ? : 'Aucun commentaire';
         $historique->date_cloture = $request->date_fin;
        $historique->save();
        $affectation->status = 'Terminé';
        $affectation->save();

        return back()->with('success', 'Stagiaire validé pour l agent!');
    }



}

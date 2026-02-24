<?php

namespace App\Http\Controllers;

use App\Models\AffectationAgent;
use App\Models\AffectionAgent;
use App\Models\AgentStagiare;
use App\Models\EcoleStage;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function index(){
     
    $affectations=AffectionAgent::all();
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

    public function addAffectation(Request $request)
{
    $validated = $request->validate([
        'agent_stagiare_id' => 'required|exists:agent_stagiares,id',
        'ecole_stage_id'    => 'required|exists:ecole_stages,id',
        'date_debut'        => 'required|date',
        'date_fin'          => 'required|date|after:date_debut',
        'type_formations'   => 'required|string|max:255'
    ], [
        'agent_stagiare_id.required' => 'Veuillez sélectionner un agent stagiaire.',
        'agent_stagiare_id.exists'   => 'L’agent sélectionné est invalide.',

        'ecole_stage_id.required'    => 'Veuillez sélectionner une école.',
        'ecole_stage_id.exists'      => 'L’école sélectionnée est invalide.',

        'date_debut.required'        => 'La date de début est obligatoire.',
        'date_debut.date'            => 'La date de début doit être valide.',

        'date_fin.required'          => 'La date de fin est obligatoire.',
        'date_fin.date'              => 'La date de fin doit être valide.',
        'date_fin.after'             => 'La date de fin doit être postérieure à la date de début.',

        'type_formations.required'   => 'Le type de formation est obligatoire.'
    ]);

    $affectation = new AffectionAgent();
    $affectation->agent_stagiare_id = $validated['agent_stagiare_id'];
    $affectation->ecole_stage_id    = $validated['ecole_stage_id'];
    $affectation->date_debut        = $validated['date_debut'];
    $affectation->date_fin          = $validated['date_fin'];
    $affectation->type_formations   = $validated['type_formations'];
    $affectation->save();

    return back()->with('success', 'L’affectation a été ajoutée avec succès.');
}





     public function EditAffectationAgent(Request $request){
          //dd($request->all());
      $data=$request->validate([
           'agent_stagiare_id'=>'required',
           'ecole_stage_id'=>'required',
           'date_debut'=>'required',
            'date_fin'=>'required',
            'type_formations'=>'required',
            'affectation_id'=>'required'

      ]);
          
      $affectation=AffectionAgent::find($request->affectation_id);
      if(!$affectation){
        
        return back();
      }
      
      $affectation->agent_stagiare_id=$request->agent_stagiare_id;
    $affectation->ecole_stage_id=$request->ecole_stage_id;
    $affectation->date_debut=$request->date_debut;
    $affectation->type_formations=$request->type_formations;
    $affectation->date_fin=$request->date_fin;
      $affectation->save();
      //toastr()->success('Information modifié avec success !');
      return back();

    }
}

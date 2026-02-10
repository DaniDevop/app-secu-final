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
     
    $affectations=AffectionAgent::paginate(9);
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

    public function addAffectation(Request $request){
          
      $data=$request->validate([
           'agent_stagiare_id'=>'required',
           'ecole_stage_id'=>'required',
           'date_debut'=>'required',
            'date_fin'=>'required'

      ]);

      $affectation=new AffectionAgent();
      $affectation->agent_stagiare_id=$request->agent_stagiare_id;
    $affectation->ecole_stage_id=$request->ecole_stage_id;
    $affectation->date_debut=$request->date_debut;
    $affectation->date_fin=$request->date_fin;
      $affectation->save();
      //toastr()->info('Agent Affecté avec success !');
      return back();

    }





     public function EditAffectationAgent(Request $request){
          
      $data=$request->validate([
           'agent_stagiare_id'=>'required',
           'ecole_stage_id'=>'required',
           'date_debut'=>'required',
            'date_fin'=>'required',
            'id'=>'required'

      ]);

      $affectation=AffectionAgent::find($request->id);
      if(!$affectation){
      }
      $affectation->agent_stagiare_id=$request->agent_stagiare_id;
    $affectation->ecole_stage_id=$request->ecole_stage_id;
    $affectation->date_debut=$request->date_debut;
    $affectation->date_fin=$request->date_fin;
      $affectation->save();
      //toastr()->success('Information modifié avec success !');
      return back();

    }
}

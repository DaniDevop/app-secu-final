<?php

namespace App\Http\Controllers;

use App\Models\AgentStagiare;
use App\Models\ServiceAgent;
use Illuminate\Http\Request;

class AgentStagiareController extends Controller
{
    //


      public function index(){

$stagiares = AgentStagiare::paginate(5);
    $servicesAll=ServiceAgent::all();

    return view('users.agent.index',compact('stagiares','servicesAll'));
    }



        
    function editAgentStagiare($id){
        $stagiareAgent=AgentStagiare::find($id);
        
        if(!$stagiareAgent){

        return back()->with('error','Stagiare inexistant');
        }
    $servicesAll=ServiceAgent::all();

        return view('users.agent.edit',compact('servicesAll','stagiareAgent'));
    }


    public function addAgentStagiare(Request $request){
        
      
        $stagiare= $request->validate([
            'name'=>'required',
            'prenom'=>'required',
            'tel'=>'required|unique:agent_stagiares,tel',
            'service_id' => 'required',
            'grade'=>'required',
            'matricule'=>'required|unique:agent_stagiares,matricule'
        ],[
            'tel.unique'=>'Le numéro de téléphone existe déjà',
            'matricule.unique'=>'Le matricule existe déjà !'
        ]); 
       
        $agent=new AgentStagiare();
        $agent->name=$stagiare['name'];
        $agent->prenom=$stagiare['prenom'];
        $agent->grade=$stagiare['grade'];
        $agent->tel=$stagiare['tel'];
        $agent->service_agent_id=$stagiare['service_id'];
        $agent->profile='';
        $agent->matricule=$stagiare['matricule'];
        $agent->save();
        return back()->with('success',' Stagiare ajouté avec success !');

    }






    
    public function EditAgentStagiareModif(Request $request){
        
      
        $stagiare= $request->validate([
            'name'=>'required',
            'prenom'=>'required',
            'tel'=>'required',
            'service_id' => 'required',
            'grade'=>'required',
            'matricule'=>'required',
            'id'=>'required'
        ]); 
       
         if(!$stagiare){

        return back()->with('error',' Informations introuvable  !');
        }
        $agent= AgentStagiare::find($stagiare['id']);
        $agent->name=$stagiare['name'];
        $agent->prenom=$stagiare['prenom'];
        $agent->grade=$stagiare['grade'];
        $agent->tel=$stagiare['tel'];
        $agent->service_agent_id=$stagiare['service_id'];
        $agent->profile='';
        $agent->matricule=$stagiare['matricule'];
        $agent->save();
               return back()->with('success',' Stagiare modifé avec success !');


    }
}

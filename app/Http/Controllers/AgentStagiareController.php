<?php

namespace App\Http\Controllers;

use App\Models\AgentStagiare;
use App\Models\ServiceAgent;
use Illuminate\Http\Request;

class AgentStagiareController extends Controller
{
    //


      public function index(){

$stagiares = AgentStagiare::get();
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


    

public function addAgentStagiare(Request $request)
{
    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'prenom'     => 'required|string|max:255',
        'tel'        => 'required|unique:agent_stagiares,tel',
        'service_id' => 'required|exists:service_agents,id',
        'grade'      => 'required',
        'matricule'  => 'required|unique:agent_stagiares,matricule'
    ], [
        'name.required'      => 'Le nom de famille est obligatoire.',
        'prenom.required'    => 'Le prénom est obligatoire.',
        'tel.required'       => 'Le numéro de téléphone est requis.',
        'tel.unique'         => 'Ce numéro est déjà utilisé.',
        'matricule.unique'   => 'Ce matricule est déjà enregistré.',
        'service_id.required'=> 'Veuillez affecter un service.',
        'service_id.exists'  => 'Le service sélectionné est invalide.',
    ]);

   $agent = new AgentStagiare(); 
   $agent->name = $validated['name']; 
   $agent->prenom = $validated['prenom']; 
   $agent->grade = $validated['grade']; 
   $agent->tel = $validated['tel'];
    $agent->service_agent_id = $validated['service_id'];
     $agent->profile = ''; 
     $agent->matricule = $validated['matricule'];
      $agent->save();
    return back()->with('success', 'Agent ajouté avec succès.');
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

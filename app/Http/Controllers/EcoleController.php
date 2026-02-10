<?php

namespace App\Http\Controllers;

use App\Models\EcoleStage;
use App\Models\ServiceAgent;
use Illuminate\Http\Request;

class EcoleController extends Controller
{
    
     public function ecole(){


       $ecoles=EcoleStage::paginate(5);

      return view('users.ecole.ecole',compact('ecoles'));
     }




      public function edit($id){
        $ecole=EcoleStage::find($id);
        if(!$ecole){

          return back()->with('error','Ecole introuvable ');
        }

        return view('users.ecole.edit',compact('ecole'));
      }


public function SaveEditEcole(Request $request)
{
    $data = $request->validate([
        'nom_ecole' => 'required',
        'adresse' => 'required',
        'id' => 'required'
    ], [
        'nom_ecole.required' => 'Le nom de l\'école est requis !',
        'adresse.required' => 'Veuillez entrer une adresse'
    ]);

    $ecoleStage = EcoleStage::find($request->id);

    if (!$ecoleStage) {
        return redirect()->back()->with('error', 'École introuvable');
    }

    $ecoleStage->update([
        'nom_ecole' => $data['nom_ecole'],
        'adresse'   => $data['adresse'],
    ]);

    return redirect()->back()->with('success', 'École modifiée avec succès !');
}

     public function addEcole(Request $request){

        $data=$request->validate([
          'nom_ecole'=>'required',
          'adresse'=>'required'
        ],[
            'nom_ecole.required'=>'Le nom de l ecole est requis !',
            'adresse.required'=>'Veuillez entrer une adresse'
        ]);

         $ecoleStage=new EcoleStage();
         $ecoleStage->nom_ecole=$data['nom_ecole'];
        $ecoleStage->adresse=$data['adresse'];
         $ecoleStage->save();
         return back()->with('success','Ecole ajouté avec success !');

     }


     // Services



     public function service(){

     
       $services=ServiceAgent::paginate(5);
      return view('users.services.index',compact('services'));
     }


     
         public function addservice(Request $request){

       $credentials = $request->validate([
            'nom_services' => ['required'],
        ]);

        $service= new ServiceAgent();
        $service->nom_services=$credentials['nom_services'];
        $service->save();
        return back()->with('success','Service ajouté avec success !');

      }




        public function editServices($id){
       $service=ServiceAgent::find($id);
       if(!$service){

        return back();
       }

       return view('users.services.edit',compact('service'));
      }




        public function editServicesPost(Request $request){


       $credentials = $request->validate([
            'nom_services' => ['required'],
            'id' => ['required'],
        ]);

         $service=ServiceAgent::find($request->id);
       if(!$service){

        return back()->with('error','Valeur introuvable ');
       }

        $service->nom_services=$credentials['nom_services'];
        $service->save();
              return back()->with('success','Service ajouté avec success !');


      }



}

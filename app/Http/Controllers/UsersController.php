<?php

namespace App\Http\Controllers;

use App\Models\AffectionAgent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AgentStagiare;
use App\Models\EcoleStage;                           
class UsersController extends Controller
{
    

      public function logout(){

      Auth::logout();
       return view('index');
      }
      public function doLogin(Request $request){
           
          $credentials=$request->validate([
              'name'=>"required",
              'password'=>'required'
          ],[
            'name.required'=>"L identifiant est requis ",
            'password.required'=>"Veuillez rentrer le mot de passe "
          ]);

           if(Auth::attempt($credentials)){
             $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
           }

             return back();

      }


      public function index(){
       
      $stageValider=AffectionAgent::where('status','Terminé')->count();
     $stageEncours=AffectionAgent::where('status','En-cours')->count();
     $stageAnnule=AffectionAgent::where('status','Annulé')->count();
     $agentCount=AgentStagiare::count();
        $EcoleStage=EcoleStage::count();

      return view('users.index',compact('stageAnnule','stageEncours','stageValider','agentCount','EcoleStage'));
      }


      public function listesAdmin(){
     $stagiares=User::paginate(5);

      return view('users.admin.index',compact('stagiares'));
      }

      public function addAdmin(Request $request){

         $request->validate([
             'name'=>'required',
             'prenom'=>'required',
             'tel'=>'required|unique:users,tel',
             'grade'=>'required',
         ],[
                'name.required'=>'Le nom de famille est obligatoire.',
                'prenom.required'=>'Le prénom est obligatoire.',
                'tel.required'=>'Le numéro de téléphone est requis.',
                'grade.required'=>'Le grade est requis.',   
         ]);

         $admin=new User();
         $admin->name=$request->name;
         $admin->prenom=$request->prenom;
         $admin->tel=$request->tel;
         $admin->grade=$request->grade;
         $admin->email=$request->name.'@gmail.com';
         $admin->role='';
         $admin->password=Hash::make($request->pasword);
         $admin->save();
         return back();

      }


      public function changesStatus($id,$status){
        
          $affectation=AffectionAgent::find($id);
          if(!$affectation){
          return back()->with('error','Affectation validé ');
          }

          $affectation->status=$status;
          $affectation->save();
          return back()->with('success','Affectation '.$status);
      }


      public function editAdmin($id){
        $admin=User::find($id);
        if(!$admin){
            return back()->with('error','Administrateur introuvable');
        }
        return view('users.admin.edit',compact('admin'));
      }


      public function updatePassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required|min:4',
        ],[
            'current_password.required'=>'Le mot de passe actuel est requis.',
            'new_password.required'=>'Le nouveau mot de passe est requis.',
            'new_password.min'=>'Le nouveau mot de passe doit comporter au moins 4 caractères.',
        ]);
        
         
        $user=Auth::user();
        if(!Hash::check($request->current_password,$user->password)){
            return back()->with('error','Mot de passe actuel incorrect.');
        }

        $user->password=Hash::make($request->new_password);
        $user->save();
        return back()->with('success','Mot de passe mis à jour avec succès.');

      }


      public function updateAdminInformation(Request $request){
        $request->validate([
            'name'=>'required',
            'prenom'=>'required',
            'tel'=>'required|unique:users,tel,'.Auth::id(),
        ],[
               'name.required'=>'Le nom de famille est obligatoire.',
               'prenom.required'=>'Le prénom est obligatoire.',
               'tel.required'=>'Le numéro de téléphone est requis.',
               
        ]);

        $user=Auth::user();
        $user->name=$request->name;
        $user->prenom=$request->prenom;
        $user->tel=$request->tel;
        $user->save();
        return back()->with('success','Informations mises à jour avec succès !');

      }
}

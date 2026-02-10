<?php

namespace App\Http\Controllers;

use App\Models\AffectionAgent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

      return view('users.index');
      }


      public function listesAdmin(){
     $stagiares=User::paginate(5);

      return view('users.admin.index',compact('stagiares'));
      }

      public function addAdmin(Request $request){

         $request->validate([
             'name'=>'required',
             'prenom'=>'required',
             'tel'=>'required',
             'grade'=>'required',
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
}

<?php

use App\Http\Controllers\AffectationController;
use App\Http\Controllers\AgentStagiareController;
use App\Http\Controllers\EcoleController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('login');

Route::post('/doLogin',[UsersController::class,'doLogin'])->name('login.user.admin');
   

Route::middleware(['user.auth'])->group(function(){
  Route::post('/logout/admin',[UsersController::class,'logout'])->name('logout');

Route::post('/administration/addAccountUser',[UsersController::class,'addAdmin'])->name('admin.add.admin');
Route::get('/administration/affectation/status/{id}/{status}',[UsersController::class,'changesStatus'])->name('changes.Status.stagiare');

Route::get('/administration/admin',[UsersController::class,'listesAdmin'])->name('admin.listes.Admin');

Route::get('/administration/dashboard',[UsersController::class,'index'])->name('admin.dashboard');
Route::get('/administration/ecole/',[EcoleController::class,'ecole'])->name('admin.ecole.index');
Route::post('/administration/ecole/addEcole',[EcoleController::class,'addEcole'])->name('admin.ecole.addEcole');
Route::get('/administration/ecole/edit/{id}',[EcoleController::class,'edit'])->name('admin.ecole.edit');
Route::post('/administration/ecole/EditEcole',[EcoleController::class,'SaveEditEcole'])->name('admin.ecole.SaveEditEcole');
Route::get('/administration/ecole/agentByEcole/{id}',[EcoleController::class,'AgentByEcole'])->name('admin.ecole.agentByEcole');
// Services


Route::get('/administration/service/',[EcoleController::class,'service'])->name('admin.service.index');
Route::post('/administration/service/ServiceAgent',[EcoleController::class,'addservice'])->name('admin.service.addService');
Route::get('/administration/service/edit/{id}',[EcoleController::class,'editServices'])->name('admin.service.edit');
Route::post('/administration/service/ServiceAgent/editService',[EcoleController::class,'editServicesPost'])->name('admin.service.editServicesPost');


// AgentStagiare

    Route::get('/users/admin/stagiare',[AgentStagiareController::class,'index'])->name('users.agent.index');  
    Route::post('/users/admin/stagiare/addStagiare',[AgentStagiareController::class,'addAgentStagiare'])->name('users.addAgent.Stagiare');  
    Route::get('/users/admin/stagiare/edit/{id}',[AgentStagiareController::class,'editAgentStagiare'])->name('users.editAgentStagiare');  
    Route::post('/users/admin/stagiare/EditAgent',[AgentStagiareController::class,'EditAgentStagiareModif'])->name('users.EditgentStagiare');
    

// Affectations
 Route::get('/users/admin/affection/agent',[AffectationController::class,'index'])->name('users.affectation.agent');  
    Route::post('/users/admin/affection/agent/ecole',[AffectationController::class,'addAffectation'])->name('users.affectation.addAffectation');  
    Route::get('/users/admin/affection/agent{edit}',[AffectationController::class,'editAffectation'])->name('users.editAffectationt.agent');  
    
    Route::post('/users/admin/affection/agent/ecole/editData',[AffectationController::class,'EditAffectationAgent'])->name('users.EditAffectationAgent.editData');  


});


  
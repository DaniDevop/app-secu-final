<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentStagiare extends Model
{
   public function services(): BelongsTo
{
    // Le deuxième paramètre devrait être 'service_agent_id' 
    // car c'est le nom de votre colonne dans agent_stagiares
    return $this->belongsTo(ServiceAgent::class, 'service_agent_id');
}


 public function affectation(){
    return $this->hasMany(AffectionAgent::class);
}
}

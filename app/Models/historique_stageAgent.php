<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class historique_stageAgent extends Model
{
     protected $table = 'historique_stage_agents';
    
    protected $fillable = [
        'affection_agent_id', // Assurez-vous que c'est le bon nom de colonne
        'moyenne',
        'mention',
        'commentaire',
        'date_de_fin'
    ];

    public function affection(): BelongsTo
    {
        return $this->belongsTo(AffectionAgent::class);
    }
}

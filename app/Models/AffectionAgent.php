<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffectionAgent extends Model
{
      protected $table = 'affection_agents'; // ou le nom correct de votre table

    public function agent(): BelongsTo
    {
        return $this->belongsTo(AgentStagiare::class, 'agent_stagiare_id');
    }

    public function ecoles(): BelongsTo
    {
        return $this->belongsTo(EcoleStage::class, 'ecole_stage_id');
    }
}

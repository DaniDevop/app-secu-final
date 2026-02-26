<?php

use App\Models\AffectionAgent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historique_stage_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AffectionAgent::class);
            $table->decimal('moyenne', 5, 2)->nullable();
            $table->string('mention');
            $table->text('commentaire')->nullable();
            $table->string('date_de_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_stage_agents');
    }
};

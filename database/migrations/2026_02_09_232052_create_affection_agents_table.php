<?php
use App\Models\AgentStagiare;
use App\Models\EcoleStage;
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
        Schema::create('affection_agents', function (Blueprint $table) {
            $table->id();
             $table->foreignIdFor(AgentStagiare::class);
            $table->foreignIdFor(EcoleStage::class);
            $table->string('date_debut');
            $table->string('date_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affection_agents');
    }
};

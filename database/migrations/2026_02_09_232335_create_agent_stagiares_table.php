<?php
use App\Models\ServiceAgent;

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
        Schema::create('agent_stagiares', function (Blueprint $table) {
            $table->id();
              $table->string('name');
            $table->string('prenom');
            $table->string('tel')->unique();
            $table->string('grade');
            $table->string('matricule')->unique();
            $table->foreignIdFor(ServiceAgent::class);
            $table->string('profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_stagiares');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')->constrained()->onDelete('cascade');
            $table->string('fichier');
            $table->enum('statut', ['depose', 'valide', 'rejete'])->default('depose');
            $table->float('note')->nullable();
            $table->text('avis_encadreur')->nullable();
            $table->text('avis_responsable')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('rapports');
    }
};

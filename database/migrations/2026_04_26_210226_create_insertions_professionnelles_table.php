<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('insertions_professionnelles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->onDelete('cascade');
            $table->foreignId('rapport_id')->constrained()->onDelete('cascade');
            $table->enum('statut', ['employe', 'en_recherche', 'poursuite_etudes'])->default('en_recherche');
            $table->string('entreprise_actuelle')->nullable();
            $table->string('poste_actuel')->nullable();
            $table->date('date_insertion')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('insertions_professionnelles');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('matricule')->unique();
            $table->string('filiere');
            $table->string('niveau'); // L1, L2, L3, M1, M2
            $table->string('telephone')->nullable();
            $table->string('cv')->nullable(); // chemin fichier
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('etudiants');
    }
};

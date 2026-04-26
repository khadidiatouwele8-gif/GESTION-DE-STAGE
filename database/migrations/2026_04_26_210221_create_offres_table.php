<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->string('domaine');
            $table->string('localisation');
            $table->integer('duree_mois');
            $table->date('date_publication');
            $table->date('date_expiration');
            $table->enum('statut', ['ouverte', 'fermee', 'expiree'])->default('ouverte');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('offres');
    }
};

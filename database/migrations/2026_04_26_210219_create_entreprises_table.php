<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('secteur');
            $table->string('adresse');
            $table->string('telephone')->nullable();
            $table->string('site_web')->nullable();
            $table->enum('statut', ['en_attente', 'validee', 'suspendue'])->default('en_attente');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('entreprises');
    }
};

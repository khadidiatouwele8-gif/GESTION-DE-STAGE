<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('entreprise_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('titre');
            $table->text('description');
            $table->string('domaine');

            $table->date('date_debut');
            $table->date('date_fin');

            $table->enum('statut', ['ouvert', 'ferme', 'en_cours'])
                  ->default('ouvert');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};

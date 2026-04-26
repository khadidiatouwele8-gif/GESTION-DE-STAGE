Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('nom'); // admin, etudiant, entreprise
    $table->timestamps();
});

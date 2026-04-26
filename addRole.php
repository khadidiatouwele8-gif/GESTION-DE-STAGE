Schema::table('users', function (Blueprint $table) {
    $table->foreignId('role_id')->after('id')->constrained()->onDelete('cascade');
});

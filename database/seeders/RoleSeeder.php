<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nom' => 'etudiant', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'entreprise', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'encadreur', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'responsable', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
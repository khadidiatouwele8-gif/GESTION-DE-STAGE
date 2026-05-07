<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => Hash::make('password'), 'role_id' => 5]);
        User::create(['name' => 'Khadija Etudiant', 'email' => 'etudiant@test.com', 'password' => Hash::make('password'), 'role_id' => 1]);
        User::create(['name' => 'Entreprise Test', 'email' => 'entreprise@test.com', 'password' => Hash::make('password'), 'role_id' => 2]);
        User::create(['name' => 'Encadreur Test', 'email' => 'encadreur@test.com', 'password' => Hash::make('password'), 'role_id' => 3]);
    }
}
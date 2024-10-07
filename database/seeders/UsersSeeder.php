<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('users')->insert([
        'name' => 'prueba',
        'email' => 'prueba@example.com',
        'email_verified_at' =>now(),
        'password' => '$2y$10$r.1e.D.QDZ7kIDFNsHtkUedBOqXE.jshiJ6OimBCz6lKj86Xu3dvG',
        'remember_token' => Str::random(10),

      ]);
    }
}

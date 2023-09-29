<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            'name' => 'Demo Account',
            'email' => 'demo@example.com',
            'password' => Hash::make("password",),
            'username'=>'demo',
            'email_verified_at' => now()

        ]);
    }
}
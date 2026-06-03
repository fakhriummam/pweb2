<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'name' => 'Fakhri',
                'email' => 'fakhri@example.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@example.com',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anika',
                'email' => 'anika@example.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
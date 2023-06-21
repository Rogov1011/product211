<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=> 'Pavel',
            'email'=> 'pavel@pavel.ru',
            'password'=> Hash::make("123456")
        ]);

        $user->assignRole('super-admin');
    }
}

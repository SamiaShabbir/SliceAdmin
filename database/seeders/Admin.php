<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\User;
use Illuminate\Support\Facades\Hash;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email'    => 'admin12@gmail.com',
            'password'   =>  Hash::make('admin'),
            'phone' => '123456',
            'address' => 'admin house',
            'role' => 'admin',
            'pin' => '12345',

        ]);
    }
}

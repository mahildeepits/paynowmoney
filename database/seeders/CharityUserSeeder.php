<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharityUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Charity User 1',
                'email' => 'charity1@gmail.com',
                'password' => '123456',
                'member_id' => 'CH0001',
                'parent_string' => '',
                'left_count' => 0,
                'right_count' => 0,
                'sponsor_id' => 'admin',
                'parent_leg' => 'left',
                'terms' => 0,
                'role' => 2,
                'is_paid' => 1,
                'user_icon' => 'userpaid.png',
                'is_franchise' => 0,
            ],
            [
                'name' => 'Charity User 2',
                'email' => 'charity2@gmail.com',
                'password' => '123456',
                'member_id' => 'CH0002',
                'parent_string' => '',
                'left_count' => 0,
                'right_count' => 0,
                'sponsor_id' => 'admin',
                'parent_leg' => 'left',
                'terms' => 0,
                'role' => 2,
                'is_paid' => 1,
                'user_icon' => 'userpaid.png',
                'is_franchise' => 0,
            ]
        ];
        foreach($data as $user){
            User::updateOrCreate([
                'email' => $user['email']
            ],[
                'name' => $user['name'],
                'password' => $user['password'],
                'enc_password' => encrypt($user['password']),
                'member_id' => $user['member_id'],
                'parent_string' => $user['parent_string'],
                'left_count' => $user['left_count'],
                'right_count' => $user['right_count'],
                'sponsor_id' => $user['sponsor_id'],
                'parent_leg' => $user['parent_leg'],
                'terms' => $user['terms'],
                'role' => $user['role'],
                'is_paid' => $user['is_paid'],
                'user_icon' => $user['user_icon'],
                'is_franchise' => $user['is_franchise'],
            ]);
        }
    }
}

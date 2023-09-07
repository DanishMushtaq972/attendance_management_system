<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecordes = [
            'id'=>'3',
            'name'=>'Admin',
            'email'=>'admin123@gmail.com',
            'email_verified_at' => now(),
            'password'=>'$2a$12$sz2kCwe3/lzb1OwF./XjDOzLJ0sn0zmn1AQlwYb1rVTYnwsljQh5.',
            'remember_token' => Str::random(10),


        ];
        Admin::insert($adminRecordes);
    }
}

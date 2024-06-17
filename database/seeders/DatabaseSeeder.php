<?php

namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users_type')->insert(
            [
                ['name' => 'Admin'],
                ['name' => 'Staff'],
            ]
        );
        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */
        $users =  [
            [
                'type_id'       => 1,
                'email'         => 'sokchhay@gmail.com',
                'phone'         => '08760063',
                'password'      => bcrypt('123456'),
                'is_active'     => 1,
                'name'          => 'sokchhay',
                'avatar'        => 'static/icon/user.png',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s')
            ],

        ];

        /*
        |--------------------------------------------------------------------------
        | Write To Database
        |--------------------------------------------------------------------------
        |
        | It will insert to table users of database minimart.
        |
        */
        DB::table('user')->insert($users);
    }
    
}

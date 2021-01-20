<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //データを追加
        User::create([
            'name' => '蛯名 虹太',
            'email' => 'ebinakota@example.com',
            'password' => Hash::make('ebinakota')
        ]);

        factory(User::class, 10)->create();
    }
}

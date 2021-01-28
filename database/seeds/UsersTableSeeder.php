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
        // テストユーザー
        User::create([
            'name' => 'ゲストユーザー',
            'email' => 'guest@guest.com',
            'password' => Hash::make('guest')
        ]);

        factory(User::class, 10)->create();
    }
}

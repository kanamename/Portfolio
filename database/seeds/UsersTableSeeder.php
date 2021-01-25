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
            'name' => '桜木花道',
            'email' => 'sakuragi@example.com',
            'password' => Hash::make('sakuragi')
        ]);

        factory(User::class, 10)->create();
    }
}

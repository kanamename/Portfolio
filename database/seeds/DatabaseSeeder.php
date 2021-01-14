<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(BrandShopTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
    }
}

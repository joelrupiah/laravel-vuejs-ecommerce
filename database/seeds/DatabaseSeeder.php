<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;
use App\Model\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // factory(Admin::class, 1)->create();
        factory(Product::class, 50)->create();
    }
}

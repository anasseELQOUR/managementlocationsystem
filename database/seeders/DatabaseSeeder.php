<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Prophecy\Call\Call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeArticleTableSeeder::class);
        // \App\Models\User::factory(10)->create();
        Article::factory(100)->create();
        Client::factory(100)->create();

        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(StatutLocationTableSeeder::class);
        $this->call(DureeLocationTableSeeder::class);

    }
}

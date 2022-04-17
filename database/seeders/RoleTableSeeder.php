<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ["nom" => "superadmin"],
            ["nom" => "admin"],
            ["nom" => "manager"],
            ["nom" => "employe"]
        ]);
    }
}

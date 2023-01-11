<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("clientes")->insert([
            [
                "uuid" => Str::uuid()->toString(),
                "nome" => "Joana Lacerda",
                "telefone" => "(42) 23232-3232",
                "email" => "lacerda@gmail.com",
                "status" => 2,
                "created_by" => 1,
                "updated_by" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "uuid" => Str::uuid()->toString(),
                "nome" => "Lucas Alercar",
                "telefone" => "(31) 26732-9252",
                "email" => "ll@gmail.com",
                "status" => 3,
                "created_by" => 1,
                "updated_by" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
        ]);
    }
}

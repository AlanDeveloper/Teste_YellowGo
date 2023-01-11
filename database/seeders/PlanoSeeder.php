<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos')->insert([
            [
                'uuid' => Str::uuid()->toString(),
                'nome' => 'Plano básico',
                'valor' => 49.99,
                'status' => true,
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'nome' => 'Plano top',
                'valor' => 89.99,
                'status' => true,
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'nome' => 'Plano muito top',
                'valor' => 129.99,
                'status' => true,
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}

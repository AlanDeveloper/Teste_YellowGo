<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ComoSoubeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('como_soube')->insert(
            [
                'uuid' => Str::uuid()->toString(),
                'titulo' => 'Facebook',
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'titulo' => 'Twitter',
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'titulo' => 'Linkedin',
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'titulo' => 'Propaganda',
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'uuid' => Str::uuid()->toString(),
                'titulo' => 'Panfleto',
                'descricao' => 'Para teste',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        );
    }
}

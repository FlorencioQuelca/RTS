<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            ["id"=>1,"nombre"=>"CHUQUISACA","estado"=>"ACTIVO"],
            ["id"=>2,"nombre"=>"LA PAZ","estado"=>"ACTIVO"],
            ["id"=>3,"nombre"=>"COCHABAMBA","estado"=>"ACTIVO"],
            ["id"=>4,"nombre"=>"ORURO","estado"=>"ACTIVO"],
            ["id"=>5,"nombre"=>"POTOSI","estado"=>"ACTIVO"],
            ["id"=>6,"nombre"=>"TARIJA","estado"=>"ACTIVO"],
            ["id"=>7,"nombre"=>"SANTA CRUZ","estado"=>"ACTIVO"],
            ["id"=>8,"nombre"=>"BENI","estado"=>"ACTIVO"],
            ["id"=>9,"nombre"=>"PANDO","estado"=>"ACTIVO"],
            ["id"=>10,"nombre"=>"CENTRAL","estado"=>"ACTIVO"],
           
            
            ]);
    }
}

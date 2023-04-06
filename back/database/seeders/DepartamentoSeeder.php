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
            ["id"=>1,"nombre"=>"CHUQUISACA"],
            ["id"=>2,"nombre"=>"LA PAZ"],
            ["id"=>3,"nombre"=>"COCHABAMBA"],
            ["id"=>4,"nombre"=>"ORURO"],
            ["id"=>5,"nombre"=>"POTOSI"],
            ["id"=>6,"nombre"=>"TARIJA"],
            ["id"=>7,"nombre"=>"SANTA CRUZ"],
            ["id"=>8,"nombre"=>"BENI"],
            ["id"=>9,"nombre"=>"PANDO"],
            ["id"=>10,"nombre"=>"CENTRAL"],
           
            
            ]);
    }
}

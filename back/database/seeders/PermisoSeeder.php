<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permisos')->insert([
            ['id'=>1,'nombre'=>'Usuarios'],
            ['id'=>2,'nombre'=>'Pedidos'],
            ['id'=>3,'nombre'=>'Depositos'],
            ['id'=>4,'nombre'=>'Fotos'],
            ['id'=>5,'nombre'=>'Proyectos'],
            ['id'=>6,'nombre'=>'Departamentos'],
           
        ]);
    }
}

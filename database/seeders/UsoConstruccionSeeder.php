<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UsoConstruccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uso_construccions')->insert([
            'type' => 1,
            'name' => 'Áreas verdes'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 2,
            'name' => 'Centro de barrio'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 3,
            'name' => 'Equipamiento'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 4,
            'name' => 'Habitacional'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 5,
            'name' => 'Habitacional y comercial'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 5,
            'name' => 'Industrial'
        ]);
        DB::table('uso_construccions')->insert([
            'type' => 4,
            'name' => 'Sin Zonificación'
        ]);
    }
}

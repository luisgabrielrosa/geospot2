<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CatastroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
                try {
                    DB::table('catastros')->insert([
                        'fid' => $data['0'],
                        'geo_shape' => $data['1'],
                        'call_numero' => $data['2'],
                        'codigo_postal' => $data['3'],
                        'colonia_predio' => $data['4'],
                        'superficie_terreno' => $data['5'],
                        'superficie_construccion' => $data['6'],
                        'uso_construccion' => $data['7'],
                        'clave_rango_nivel' => $data['8'],
                        'anio_construccion' => $data['9'],
                        'instalaciones_especiales' => $data['10'],
                        'valor_unitario_suelo' => isset($data['11'])?"":$data['11'],
                        'valor_suelo' => $data['12'],
                        'clave_valor_unitario_suelo' => isset($data['13'])?"":$data['13'],
                        'colonia_cumpliemiento' => $data['14'],
                        'alcaldia_cumplimiento' => $data['15'],
                        'subsidio' => $data['16']
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            $firstline = false;

        }

   

        fclose($csvFile);
     
    }
}

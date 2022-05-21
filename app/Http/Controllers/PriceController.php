<?php

namespace App\Http\Controllers;

use App\Models\price;
use Illuminate\Http\Request;
use App\Http\Requests\StorepriceRequest;
use App\Http\Requests\UpdatepriceRequest;
use App\Models\Catastro;
use App\Models\UsoConstruccion;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $data = $this->GetData($request['zip_code'], $request['construction_type']);
       $calculos = [];
        foreach ($data as $key => $value) {
           $calculos[count($calculos)] = array(
               "id" => $value->id,
               "price_unit" => $this->price_unit(floatval($value->superficie_terreno), floatval($value->valor_suelo), floatval($value->subsidio)),
               "price_unit_construction" => $this->price_unit_construction(floatval($value->superficie_construccion), floatval($value->valor_suelo), floatval($value->subsidio)),
           );           
        }
        $payload = $this->GetPayload($request['aggregate'], $calculos);
        $r = array(
            'status' => isset($payload),
            'payload' => $payload
        );
        return response()->json($r, 200);
    }

    private function GetPayload($aggregate, $data){
        $_result = [];
        switch ($aggregate) {
            case 'min':
                $_result = $this->GetMin($data);
                break;
            case 'max':
                $_result = $this->GetMax($data);
                break;
            case 'avg':
                $_result = $this->GetAvg($data);
                break;
            default:
                $_result = null;
                break;
        }

        return $_result;
    }


    private function GetMin($data){
        $_min = $data[0]['price_unit'];
        $_result = [];
        foreach ($data as $key => $value) {
            if($_min > $value['price_unit']){
                $_min = $value['price_unit'];
                $_result = array(
                    "type"=>"min",
                    "price_unit"=> $value['price_unit'],
                    "price_unit_construction"=> $value['price_unit_construction'],
                    "elements" => count($data)
                );
            }
        }
        return $_result;
    }

    private function GetMax($data){
        $_max = $data[0]['price_unit'];
        $_result = [];
        foreach ($data as $key => $value) {
            if($_max < $value['price_unit']){
                $_max = $value['price_unit'];
                $_result = array(
                    "type"=>"max",
                    "price_unit"=> $value['price_unit'],
                    "price_unit_construction"=> $value['price_unit_construction'],
                    "elements" => count($data)
                );
            }
        }
        return $_result;
    }

    private function GetAvg($data){
        $sum_price_unit=0;
        $sum_price_unit_construction=0;
        foreach ($data as $key => $value) {
            $sum_price_unit += floatval($value['price_unit']);
            $sum_price_unit_construction += floatval($value['price_unit_construction']);
        }
        return array(
            "type"=>"avg",
            "price_unit"=> $sum_price_unit/count($data),
            "price_unit_construction"=> $sum_price_unit_construction/count($data),
            "elements" => count($data)
        );
    }
    private function GetData($zip_code, $construction_type){
        
        $_result = null;
        try {
            if(!isset($construction_type)){
                $_result = Catastro::where('codigo_postal', $zip_code)->get();
            }else{
                $uso_construccion = UsoConstruccion::where("type", $construction_type)->first();
                $_result = Catastro::where('codigo_postal', $zip_code)->where('uso_construccion', $uso_construccion->name)->get();            
            }
        } catch (\Throwable $th) {
            $_result = null;
        }
        return $_result;
    }

    private function price_unit($superficie_terreno, $valor_suelo, $subsidio){
        if(floatval($superficie_terreno) == 0 || floatval($valor_suelo)  == 0)
            return 0;

        return floatval($superficie_terreno) / floatval($valor_suelo) - floatval($subsidio);
    }
    
    private function price_unit_construction($superficie_construccion, $valor_suelo, $subsidio){
        if(floatval($superficie_construccion) == 0 || floatval($valor_suelo)  == 0)
            return 0;

        return floatval($superficie_construccion) / floatval($valor_suelo) - floatval($subsidio);
    }
}

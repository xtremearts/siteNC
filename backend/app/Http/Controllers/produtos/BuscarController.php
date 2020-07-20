<?php

namespace App\Http\Controllers\produtos;

use App\Http\Controllers\Controller;
use App\models\Buscar;
use Illuminate\Http\Request;

class BuscarController extends Controller
{
    function exibirBusca($buscar){
        $data = Buscar::exibirBuscaModel($buscar);
        return $data->toArray();
    }

    function exibirApiTemporaria($id){
        $data = Buscar::apiTemporariaModel($id);
        return $data->toArray();
    }



    function exibirApiTemporariaArray(){
        $data = Buscar::apiTemporariaModel($_REQUEST->produtos);
        return $data->toArray();
    }
}

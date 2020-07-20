<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdutoDescricao extends Model
{
    protected $table = 'tb_descricao';
    protected $primaryKey = 'cod_nc';

    public static function exibirProdutosDescricaoModel(){
        $data = DB::table('tb_descricao')
        ->select(DB::raw('cod_nc as id, cod_nome, descricao, emb, ordenar, ordenar2, ordenar3, cod_nc_img'))
        ->orderByRaw('ordenar, ordenar2, ordenar3, descricao')
        ->get();
        return $data;
    }

    public static function exibirProdutosDescricaoIdModel($id){
        $data = DB::table('tb_descricao')
        ->select(DB::raw('
                            cod_nc as id,
                            cod_nome,
                            descricao,
                            emb,
                            ordenar,
                            ordenar2,
                            ordenar3,
                            case
                                when cod_nc_img is null or cod_nc_img = "" then cod_nome
                                else cod_nc_img
                            end as cod_nc_img
                            '
                        ))
        ->where('cod_nome', $id)
        ->orderByRaw('ordenar, ordenar2, ordenar3, descricao')
        ->get();
        return $data;
    }

    public static function exibirProdutoDescricaoIndexIdModel($id){
        $data = DB::table('tb_descricao')
        ->select(DB::raw(' distinct
                            case
                                when cod_nc_img is null or cod_nc_img = "" then cod_nome
                                else cod_nc_img
                            end as cod_nc_img
                        '
                        ))
        ->where('cod_nome', $id)
        // ->orderByRaw('ordenar, ordenar2, ordenar3, descricao')
        ->get();
        return $data;
    }
}
<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProdutosNome extends Model
{
    protected $table = 'tb_nome';
    protected $primaryKey = 'cod_nome';

    public static function exibirProdutosNomeModel(){
        $produtosNome = DB::table('tb_nome')
        ->select(DB::raw('cod_nome as id, nome, cod_fornecedor, cod_grupo, cod_subgrupo, ordenar, ordenar2, ordenar3'))
        ->get();
        return $produtosNome;
    }

    public static function exibirProdutosNomeModelId($id){
        $produtosNome = DB::table('tb_nome')
        ->select(DB::raw('cod_nome as id, nome, cod_fornecedor, cod_grupo, cod_subgrupo, ordenar, ordenar2, ordenar3'))
        ->where('cod_nome', $id)
        ->get();
        return $produtosNome;
    }

    public static function exibirProdutosNomeGrupoModelId($id){
        $n = 'tb_nome';
        $d = 'tb_descricao';
        $f = 'tb_fornecedores';

        $produtosNomeGrupo = DB::table('tb_nome')
        ->leftJoin(
            $f, $n.'.cod_fornecedor', '=' , $f.'.cod_fornecedor')
        ->select(DB::raw('cod_nome as id, nome, cod_index, tb_nome.cod_fornecedor, fornecedor, cod_grupo, cod_subgrupo, ordenar, ordenar2, ordenar3'))
        ->where('cod_grupo', $id)
        ->orderByRaw($n.'.nome')
        ->get();
        return $produtosNomeGrupo;
    }

    public static function exibirProdutosNomeIndexId($id){
        $data = DB::table('tb_nome')
        ->select(DB::raw('cod_nome as id, nome, cod_index, cod_fornecedor, cod_grupo, cod_subgrupo, ordenar, ordenar2, ordenar3'))
        ->where('cod_index', $id)
        ->limit(12)
        ->get();
        return $data;
    }
}
<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buscar extends Model
{

    

    public static function exibirBuscaModel($buscar){
        // tabelas
        $n = 'tb_nome';
        $d = 'tb_descricao';
        $f = 'tb_fornecedores';

        $data = DB::table($n)
        ->distinct()
        ->leftJoin($d, $d.'.cod_nome', '=', $n.'.cod_nome')
        ->leftJoin($f, $f.'.cod_fornecedor', '=', $n.'.cod_fornecedor')
        ->select($n.'.cod_nome', $n.'.nome', $f.'.fornecedor', $f.'.cod_fornecedor', $n. '.cod_index')

        ->whereIn($d.'.cod_filial', [2, 4, 12])

        ->where(function($query) use($n, $d, $f, $buscar) {
            $query
            ->orWhere($n.'.nome','like',"%$buscar%")
            ->orWhere($d.'.cod_nc','like',"%$buscar%")
            ->orWhere($d.'.descricao','like',"%$buscar%")
            ->orWhere($f.'.fornecedor','like',"%$buscar%");
        })
        ->orderBy($n.'.nome')
        ->get();
        return $data;
    }

    public static function apiTemporariaModel($id){
        $wp = 'tb_w_produto';
        $wpf = 'tb_w_produto_filial';

        $data = DB::table($wp)
        ->where($wp.'.codprod', '=', $id)
        ->where($wpf.'.codfilial', '=', '2')
        ->select(
            DB::raw(
                "
                $wpf.codfilial,
                $wp.codprod id,
                $wp.descricao,
                $wp.embalagem,
                $wp.codfab,
                $wp.unidade,
                rand(13) codauxiliar,
                rand(13) codauxiliar2,
                rand(13) codauxiliartrib,
                
                case
                    when $wp.obs = 'PV' then 'S'
                    else $wpf.proibidavenda
                end proibidavenda,
                    
                case
                    when $wp.obs2 = 'FL' then 'S'
                    else $wpf.foralinha
                end foralinha,

                'S' revenda,
                $wpf.multiplo,
                'Informações técnicas' informacoestecnicas
                "
                )
            )
            ->leftJoin($wpf, $wpf. '.codprod', '=', $wp.'.codprod')
            ->get();

            return $data;
            ;
    }


    

    public static function apiTemporariaModelArray($produtos){
        $wp = 'tb_w_produto';
        $wpf = 'tb_w_produto_filial';

        $data = DB::table($wp)
        ->where($wpf.'.codfilial', '=', '2')
        ->whereIn($wp.'.codprod', [$produtos])
        ->select(
            DB::raw(
                "
                $wpf.codfilial,
                $wp.codprod id,
                $wp.descricao,
                $wp.embalagem,
                $wp.codfab,
                $wp.unidade,
                rand(13) codauxiliar,
                rand(13) codauxiliar2,
                rand(13) codauxiliartrib,
                
                case
                    when $wp.obs = 'PV' then 'S'
                    else $wpf.proibidavenda
                end proibidavenda,
                    
                case
                    when $wp.obs2 = 'FL' then 'S'
                    else $wpf.foralinha
                end foralinha,

                'S' revenda,
                $wpf.multiplo,
                'Informações técnicas' informacoestecnicas
                "
                )
            )
            ->leftJoin($wpf, $wpf. '.codprod', '=', $wp.'.codprod')
            ->get();

            return $data;
            ;
    }
}

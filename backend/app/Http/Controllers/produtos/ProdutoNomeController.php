<?php

namespace App\Http\Controllers\produtos;

use App\Http\Controllers\Controller;
use App\models\ProdutosNome;
use Illuminate\Http\Request;

class ProdutoNomeController extends Controller
{
    function exibirProdutosNomeId($id){
        $produtosNome = ProdutosNome::exibirProdutosNomeModelId($id);
        return $produtosNome->toArray();
    }

    function exibirProdutosNome(){
        $produtosNomes = ProdutosNome::exibirProdutosNomeModel();
        return $produtosNomes->toArray();
    }

    function exibirProdutosNomeGrupoId($id){
        $produtosNomeGrupoId = ProdutosNome::exibirProdutosNomeGrupoModelId($id);
        return $produtosNomeGrupoId->toArray();
    }

    function exibirProdutosNomeIndexId($id){
        $data = ProdutosNome::exibirProdutosNomeIndexId($id);
        return $data->toArray();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lineproof;
use Illuminate\Support\Facades\DB;

class LineproofController extends Controller
{
    public function inventory(){
        $articles = DB::table('articles')->select('articles.id','articles.stockMinArticle')->orderBy('articles.id','asc')->get();
        $cantForArticle = array();

        $cantArticles = count($articles);
        for ($i=0; $i < $cantArticles; $i++) {
            $articleNow = DB::table('lineproofs')
            ->join('headproofs','headproofs.id','=','lineproofs.headproof_id')
            ->select('lineproofs.id','lineproofs.article_id','lineproofs.quantity_movement','headproofs.type_movement')
            ->where('lineproofs.article_id', '=', $articles[$i]->id)
            ->get();
            
            $cantOperations = count($articleNow);
            $cantArticleNow = 0;
        
            for ($j=0; $j < $cantOperations; $j++) {
                if ($articleNow[$j]->type_movement == 'Compra') {
                    $cantArticleNow = $cantArticleNow + $articleNow[$j]->quantity_movement;
                }else{
                    $cantArticleNow = $cantArticleNow - $articleNow[$j]->quantity_movement;
                }
            }
            $cantForArticle[$i] = $cantArticleNow;
        }
        
        // Tabla que se mostrará en el request
        $sql = DB::table('categories')
        ->join('articles','articles.category_id','=','categories.id')
        ->select('categories.id','articles.nameArticle','categories.nameCategory','articles.priceArticle')->orderBy('articles.id','asc')
        ->get();

        // En cada artículo agrega una propiedad que indica la cantidad actual de cada artículo
        for ($i=0; $i < $cantArticles; $i++) { 
            $props = 'cantForArticle';
            $sql[$i]->{$props} = $cantForArticle[$i];
        }

        // En cada artículo agrega una propiedad que indica el precio total que se tiene de cada artículo
        for ($i=0; $i < $cantArticles; $i++) { 
            $props = 'total';
            $sql[$i]->{$props} = $cantForArticle[$i] * $sql[$i]->priceArticle;
        }

        // Detecta cuales articulos tienen menos stock actualmente del minimo de c/u
        for ($i=0; $i < $cantArticles; $i++) {
            $props = 'littleStock';
            if ($sql[$i]->cantForArticle <= $articles[$i]->stockMinArticle) {
                $sql[$i]->{$props} = true;
            }
        }

        return $sql;
    }
}

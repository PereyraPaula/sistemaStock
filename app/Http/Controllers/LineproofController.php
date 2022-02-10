<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lineproof;
use Illuminate\Support\Facades\DB;

class LineproofController extends Controller
{
    public function inventory(){
        $total = array();
        $articles = DB::table('articles')->select('articles.id','articles.stockMinArticle')->orderBy('articles.id','asc')->get();
        $total = count($articles);
        $cantForArticle = array();

        for ($i=0; $i < $total ; $i++) {

            // Busqueda en c/ renglon de todos los comprobantes si se compró/vendió cierto artículo.
            $articleSelected = DB::table('lineproofs')
            ->join('headproofs','headproofs.id','=','lineproofs.headproof_id')
            ->select('lineproofs.id','lineproofs.article_id','lineproofs.quantity_movement','headproofs.type_movement')
            ->where('lineproofs.article_id', '=', $articles[$i]->id)
            ->get();
            
            $operationsPerArticle = count($articleSelected);
            $cantArticleNow = $articles[$i]->stockMinArticle;
        
            for ($j=0; $j < $operationsPerArticle; $j++) {
                if ($articleSelected[$j]->type_movement == 'Compra') {
                    $cantArticleNow = $cantArticleNow + $articleSelected[$j]->quantity_movement;
                }else{
                    $cantArticleNow = $cantArticleNow - $articleSelected[$j]->quantity_movement;
                }
            }
            $cantForArticle[$i] = $cantArticleNow;
        }
        
        // Tabla que se mostrará en el request
        $sql = DB::table('categories')
        ->join('articles','articles.category_id','=','categories.id')
        ->select('categories.id','articles.nameArticle','categories.nameCategory','articles.priceArticle')
        ->get();

        // En cada artículo agrega una propiedad que indica la cantidad actual de cada artículo
        for ($i=0; $i < $total; $i++) { 
            $props = 'cantForArticle';
            $sql[$i]->{$props} = $cantForArticle[$i];
        }

        // Agrega propiedad que indica el precio total de cada artículo
        for ($i=0; $i < $total; $i++) { 
            $props = 'total';
            $sql[$i]->{$props} = $cantForArticle[$i] * $sql[$i]->priceArticle;
        }

        // Articulos que tienen menos stock actualmente del minimo
        for ($i=0; $i < $total; $i++) {
            $props = 'littleStock';
            if ($sql[$i]->cantForArticle <= $articles[$i]->stockMinArticle) {
                $sql[$i]->{$props} = true;
            }
        }

        $sql['total_articles'] = $total;
        $sql['total_categories'] = DB::table('categories')->count();
        $sql['total_receipts'] = DB::table('headproofs')->count();

        return $sql;
    }
}

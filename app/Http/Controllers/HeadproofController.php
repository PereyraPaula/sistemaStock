<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Headproof;
use App\Models\Lineproof;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HeadproofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headproof = Headproof::all();
        return $headproof->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // {
        //     "type_movement": "Venta",
        //     "date_movement": "2021-06-12",
        //     "OrderedData": [
        //         {
        //             "id_art": 3,
        //             "cant_article": 10
        //         },
        //         {
        //             "id_art": 2,
        //             "cant_article": 50
        //         },
        //         {
        //             "id_art": 4,
        //             "cant_article": 50
        //         }
        //     ]
        // }

        $v = Validator::make($request->all(),[
            'type_movement' => 'required',
            'date_movement' => 'required',
        ]);

        if($v->fails()){
            return response()->json(['Estado'=>'Error','Mensaje'=>'Verifique si todos los datos están o está escrito correctamente']);
        }else{
            try {
                DB::beginTransaction();

                $headproof = Headproof::create([
                    "type_movement" => $request->input('type_movement'),
                    "date_movement" => $request->input('date_movement'),
                ]);

                //dd($headproof->toJson(JSON_PRETTY_PRINT));

                $orderedItems = $request->OrderedData;
                $cant_articles = count($orderedItems);   

                for ($i=0; $i < $cant_articles; $i++) { 
                    $lineproof = Lineproof::create([
                        'headproof_id' => $headproof->id,
                        'article_id' => $request->OrderedData[$i]['id_art'],
                        'quantity_movement' => $request->OrderedData[$i]['cant_article'],
                    ]);
                }
                
                $cant_articles = 0;
                DB::commit();

            } catch (\Exception $e) {
                //dd($e);
                DB::rollback();
                return response()->json(["Message" => 'Error']);
            }
        }

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headproof $headproof)
    {
        Headproof::destroy($headproof->id);
        return response()->json(['Estado' => 'Satisfactorio', 'Mensaje' => 'Cabecera del comprobante eliminado']);
    }
}

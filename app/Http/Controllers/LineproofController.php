<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lineproof;

class LineproofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $lineproofs = Lineproof::all();
        return $lineproofs->toJson(JSON_PRETTY_PRINT);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lineproofs= new Lineproof;
        $lineproofs->article_id=$request->input('article_id');
        $lineproofs->quantity_movement=$request->input('quantity_movement');
        $lineproofs->headproof_id=$request->input('headproof_id');
        $lineproofs->save();
        return $lineproofs->toJson(JSON_PRETTY_PRINT) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lineproofs = Lineproof::find($id);
        return $lineproofs->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lineproof $lineproof)
    {
        $lineproof->update($request->all());
        return response()->json($lineproof,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lineproof $lineproof)
    {
        Lineproof::destroy($lineproof->id);
        return response()->json(['Estado' => 'Satisfactorio', 'Mensaje' => 'Artículo eliminado']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Headproof;

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
        $headproof = new Headproof;
        $headproof->type_movement = $request->input('type_movement');
        $headproof->date_movement = $request->input('date_movement');
        $headproof->save();
        return $headproof->toJson(JSON_PRETTY_PRINT);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headproof = Headproof::find($id);
        return $headproof->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Headproof $headproof)
    {
        $headproof->update($request->all());
        return response()->json($headproof,200);
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

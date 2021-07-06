<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LastMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastMovements = DB::table('headproofs')
        ->join('lineproofs','lineproofs.headproof_id','=','headproofs.id')
        ->select('headproofs.id','headproofs.type_movement','headproofs.date_movement','lineproofs.quantity_movement')->orderBy('date_movement','desc')
        ->get();

        return $lastMovements->toJson(JSON_PRETTY_PRINT);
    }
}

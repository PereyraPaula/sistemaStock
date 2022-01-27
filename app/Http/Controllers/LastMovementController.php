<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LastMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maxPage = 5;

        $movements = DB::table('headproofs')
        ->join('lineproofs','lineproofs.headproof_id','=','headproofs.id')
        ->select('headproofs.id','headproofs.type_movement','headproofs.date_movement','lineproofs.quantity_movement')->orderBy('date_movement','desc')
        ->paginate($maxPage);

        return [
            "pagination"=>[
                'total' => $movements->total(),
                'current_page' => $movements->currentPage(),
                'per_page' => $movements->perPage(),
                'last_page' => $movements->lastPage(),
                'from' => $movements->firstItem(),
                'to' => $movements->lastPage(),
            ],
            "movements" => $movements
        ];

    }
}

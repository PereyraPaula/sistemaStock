<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineproof extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="lineproofs";
    protected $fillable = [
        'article_id',
        'quantity_movement',
        'headproof_id'
    ];

    public function article(){
        return $this->belongsTo('App\Models\Article');
    }

    public function headproof(){
        return $this->belongsTo('App\Models\Headproof');
    }
    
}

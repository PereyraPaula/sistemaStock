<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headproof extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="headproofs";

    protected $fillable = [
        'type_movement',
        'date_movement',
    ];

    public function lineproofs(){
        return $this->hasMany('App\Models\Lineproof');
    }
}

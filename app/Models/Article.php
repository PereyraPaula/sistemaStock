<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table="articles";

    protected $fillable = [
        'nameArticle',
        'priceArticle',
        'stockMinArticle',
        'stockMaxArticle',
        'dateExpirationArt',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function lineproofs(){
        return $this->hasMany('App\Models\Lineproof');
    }
}

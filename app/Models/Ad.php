<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    public function category(){

        return $this->belongsTo('\App\Models\Category');

    }
}

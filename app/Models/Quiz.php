<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Record;

class Quiz extends Model
{
    //
    function category(){
        return $this->belongsTo(category::class);
    }

    function Mcq(){
        return $this->hasMany(Mcq::class);
    }

    function Records(){
        return $this->hasMany(Record::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultdetails extends Model
{
    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }
}

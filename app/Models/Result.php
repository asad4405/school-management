<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function resultdetails()
    {
        return $this->hasMany(Resultdetails::class, 'result_id');
    }
}

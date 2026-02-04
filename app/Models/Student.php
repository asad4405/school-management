<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function student()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

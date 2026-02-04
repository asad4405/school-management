<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function teacher()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

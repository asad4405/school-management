<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEntollment extends Model
{
    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
    public function class()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }
}

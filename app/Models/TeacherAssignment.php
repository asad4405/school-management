<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAssignment extends Model
{
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }
    public function class_subject()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }
}

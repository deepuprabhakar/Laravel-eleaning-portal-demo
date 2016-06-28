<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
     protected $fillable = ['student_id', 'score', 'attended'];
}

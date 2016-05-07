<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'score', 'attended'];

    /**
     * Relations
     */
    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject');
    }
}

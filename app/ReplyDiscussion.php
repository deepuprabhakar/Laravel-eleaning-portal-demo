<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReplyDiscussion extends Model
{
    protected $fillable = [
    'student_id','subject_id','answer',
    ];

    protected $appends = ['time'];

    public function getTimeAttribute()
    {
    	$time = new Carbon($this->attributes['created_at']);
    	return $time->diffForHumans();
    }

    public function getAnswerAttribute()
    {
    	return ucfirst(nl2br($this->attributes['answer']));
    }

    public function student()
	{
		return $this->belongsTo('App\Student');
	}
}

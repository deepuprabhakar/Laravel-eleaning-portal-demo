<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class DiscussionPrompt extends Model
{
   protected $table = 'discussionprompt';
   protected $fillable =[
   		'question','subject_id','course_id',
   ];

   public function setSubjectIdAttribute($id)
	{
		$this->attributes['subject_id'] = Hashids::connection('subject')->decode($id)[0];
	}

	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Quiz extends Model
{
    protected $fillable = [
    	'question','A','B','C','D'
  		,'answer','subject_id',
    ];

    public function setSubjectIdAttribute($id)
	{
		$this->attributes['subject_id'] = Hashids::connection('subject')->decode($id)[0];
	}

	protected $appends = ['hashid'];

	public function getHashidAttribute()
    {
        return Hashids::connection('quiz')->encode($this->attributes['id']);
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject','subject_id');
    }
}

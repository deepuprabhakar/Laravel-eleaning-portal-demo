<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class Assignment extends Model implements SluggableInterface
{

	use SluggableTrait;

    protected $fillable = [
    	'title', 'file', 'subject_id', 'student_id', 'score', 'remark', 'slug',
    ];

    protected $sluggable = [
	    'build_from' => 'title',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];


    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('assignment')->encode($this->attributes['id']);
    }
    public function getRemarkAttribute($value)
	{
		return ucfirst($value);
	}


    public function student()
	{
		return $this->belongsTo('App\Student');
	}
	
	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}
}

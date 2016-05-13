<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class Subject extends Model implements SluggableInterface
{

	use SluggableTrait;

	protected $fillable = [
		'name', 'batch', 'course', 'semester', 'slug', 'file'
	];

	protected $sluggable = [
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

	protected $appends = ['hashid'];

	public function getNameAttribute($value)
	{
		return ucwords($value);
	}

	public function getHashidAttribute()
    {
        return Hashids::connection('subject')->encode($this->attributes['id']);
    }

    /**
     * Relations
     */
    
    public function course()
    {
        return $this->belongsTo('App\Course', 'course');
    }

    public function unit()
    {
    	return $this->hasMany('App\Unit', 'subject_id');
    }

    public function discussionprompt()
    {
    	return $this->hasOne('App\DiscussionPrompt');
    }

    public function quiz()
    {
        return $this->hasMany('App\Quiz');
    }

    public function assignment()
    {
        return $this->hasOne('App\Assignment');
    }

    public function quizresult()
    {
        return $this->hasMany('App\QuizResult');
    }
    

  
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;
use Carbon\Carbon;

class Student extends Model implements SluggableInterface
{

	use SluggableTrait;

	protected $dates = ['dob'];

	protected $fillable = [
		'name', 'slug', 'email', 'admission', 'gender', 'course', 'batch', 'dob', 'phone', 'address', 'qualification', 'user_id',
	];

	protected $sluggable = [
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

	protected $appends = ['hashid'];

	public function setDobAttribute($date)
	{
		$this->attributes['dob'] = Carbon::parse($date);
	}

	public function getHashidAttribute()
    {
        return Hashids::connection('student')->encode($this->attributes['id']);
    }

    public function getNameAttribute()
    {
    	return ucwords($this->attributes['name']);
    }

    public function getDobAttribute()
    {
    	$dob = new Carbon($this->attributes['dob']);
    	return $dob->format('m/d/Y');
    }

    /**
     * Relations
     */
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function course()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }

    public function getCourse()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }

    public function replyDiscussion()
    {
        return $this->hasMany('App\ReplyDiscussion');
    }


    public function quizresult()
    {
        return $this->hasMany('App\QuizResult');
    }

    public function assignment()
    {
        return $this->hasMany('App\Assignment');
    }

    public function project()
    {
        return $this->hasOne('App\Projects');

    }
    

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;
use Carbon\Carbon;

class Teacher extends Model implements SluggableInterface
{
    use SluggableTrait;

	protected $dates = ['dob'];

	protected $fillable = [
		'firstname', 'slug', 'lastname', 'gender','email',  'salary', 'join', 'dob', 'phone', 'address', 'qualification', 'user_id',
	];

	protected $sluggable = [
	    'build_from' => 'firstname',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

	protected $appends = ['hashid'];

	public function setDobAttribute($date)
	{
		$this->attributes['dob'] = Carbon::parse($date);
	}

    public function setJoinAttribute($date)
    {
        $this->attributes['join'] = Carbon::parse($date);
    }

	public function getHashidAttribute()
    {
        return Hashids::connection('teacher')->encode($this->attributes['id']);
    }

    public function getFirstnameAttribute()
    {
    	return ucwords($this->attributes['firstname']);
    }

    public function getLastnameAttribute()
    {
    	return ucwords($this->attributes['lastname']);
    }

    public function getDobAttribute()
    {
    	$dob = new Carbon($this->attributes['dob']);
    	return $dob->format('m/d/Y');
    }
    public function getJoinAttribute()
    {
    	$join = new Carbon($this->attributes['join']);
    	return $join->format('m/d/Y');
    }
    
}

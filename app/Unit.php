<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;


class Unit extends Model implements SluggableInterface
{
	use SluggableTrait;

	protected $fillable = [
		'title','subject_id', 'content','video',
	];
	protected $sluggable = [
	    'build_from' => 'title',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

	protected $appends = ['hashid'];

	public function setSubjectIdAttribute($id)
	{
		$this->attributes['subject_id'] = Hashids::connection('subject')->decode($id)[0];
	}

	public function getHashidAttribute()
    {
        return Hashids::connection('unit')->encode($this->attributes['id']);
    }

	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}

	public function getTitleAttribute()
	{
		return ucwords($this->attributes['title']);
	}
}

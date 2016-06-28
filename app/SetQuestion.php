<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;


class SetQuestion extends Model implements SluggableInterface
{
   use SluggableTrait; 

    protected $fillable = [
        'title','slug','timehr','timemin','category','noquestion','mark','negativemark',
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
        return Hashids::connection('setquestion')->encode($this->attributes['id']);
    }
}

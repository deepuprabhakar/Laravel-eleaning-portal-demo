<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class TestQuestion extends Model implements SluggableInterface
{
   use SluggableTrait; 

    protected $fillable = [
        'question','A','B','C','D'
  		,'answer','slug','category',
    ];
    protected $sluggable = [
	    'build_from' => 'question',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];
	protected $appends = ['hashid'];

	public function getHashidAttribute()
    {
        return Hashids::connection('question')->encode($this->attributes['id']);
    }
}

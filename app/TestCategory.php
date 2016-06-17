<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class TestCategory extends Model implements SluggableInterface
{
    use SluggableTrait; 

    protected $fillable = [
        'name'
    ];
    protected $sluggable = [
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];
	protected $appends = ['hashid'];
	public function getHashidAttribute()
    {
        return Hashids::connection('category')->encode($this->attributes['id']);
    }

}

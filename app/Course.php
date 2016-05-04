<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class Course extends Model implements SluggableInterface
{
    
	use SluggableTrait;

    protected $fillable = [
    	'title', 'semester', 'slug',
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'on_update'  => 'true',
        'unique'     => 'true'
    ];

    public function getTitleAttribute($value)
    {
    	return ucwords($value);
    }

    public function getHashidAttribute()
    {
        return Hashids::connection('course')->encode($this->attributes['id']);
    }

    /**
     * Relations
     */
    
    public function subject()
    {
        return $this->hasMany('App\Subject', 'course', 'id');
    }

    public function news()
    {
        return $this->hasMany('App\News','course','id');
    }

    public function courseinfo()
    {
        return $this->hasOne('App\CourseInfo');
    }
}

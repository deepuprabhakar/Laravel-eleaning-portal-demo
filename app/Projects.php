<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Hashids;

class Projects extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = [
    		'topic', 'description', 'project', 'student_id', 'course_id', 'slug', 'score', 'remarks', 'batch',
    ];

    protected $sluggable = [
	    'build_from' => 'topic',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

	protected $appends = ['hashid'];
    
	public function getHashidAttribute()
    {
        return Hashids::connection('project')->encode($this->attributes['id']);
    }

    public function getRemarksAttribute($value)
    {
        return ucfirst($value);
    }
    
    /**
     * Relations
     */

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

}

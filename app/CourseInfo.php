<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{

	protected $table = 'course_info';
    protected $fillable = [
    	 'course_id', 'content',
    ];

    /**
     * Relations
     */
    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }
}

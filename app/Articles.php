<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Carbon\Carbon;
use Hashids;


class Articles extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $fillable = [
    			'title','content','publish', 'article','student_id'
    ];

    protected $sluggable = [
	    'build_from' => 'title',
	    'save_to'    => 'slug',
	    'on_update'  => 'true',
	    'unique'     => 'true'
	];

    protected $appends = ['hashid'];

	protected $dates = ['publish'];
    
    public function setPublishAttribute($publish)
    {
    	date_default_timezone_set('Asia/Kolkata');
    	$date = Carbon::createFromFormat('m/d/Y', $publish);
    	$today = Carbon::now();
    	if($date->gt($today))
    	{
    		$this->attributes['publish'] = Carbon::parse($publish);
    	}
    	else
    	{
    		$this->attributes['publish'] = $date;
    	}
    	
    }
    public function scopePublished($query)
    {   
        return $query->where('publish', '<=', Carbon::now());
    }

 
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getHashidAttribute()
    {
        return Hashids::connection('article')->encode($this->attributes['id']);
    }

    public function scopeActive($query)
    {
        $today = Carbon::now();
        return $query->where('publish', '<=', $today)->orderBy('publish', 'desc');
    }

    /**
     * Relations
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'student_id');
    }
}

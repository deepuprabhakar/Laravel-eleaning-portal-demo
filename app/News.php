<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Carbon\Carbon;
use Hashids;


class News extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $fillable = [
    	'title','content','publish','image','slug','course','batch', 'audience',
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

    public function getHashidAttribute()
    {
        return Hashids::connection('news')->encode($this->attributes['id']);
    }

    /* *

    *Relations
    
    **/

    public function course()
    {
        return $this->belongsTo('App\Course', 'course');
    }

    public function scopePublished($query)
    {   
        return $query->where('publish', '<=', Carbon::now());
    }

    public function getTitleAttribute()
    {
        return ucfirst($this->attributes['title']);
    }

    public function scopeActive($query)
    {
        $today = Carbon::now();
        return $query->where('publish', '<=', $today);
    }
}

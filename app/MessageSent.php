<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use Carbon\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;

class MessageSent extends Model
{
	protected $table = "messages";

    use SearchableTrait;
    
    protected $fillable =[
   		 'to', 'subject', 'message', 'sender', 
   ];

   protected $searchable = [
        'columns' => [
            'messages.subject' => 10,
            'users.first_name' => 10,
        ],
        'joins' => [
            'users' => ['messages.to','users.id'],
        ],
    ];

   protected $appends = ['hashid', 'time','create'];

   public function getHashidAttribute()
   {
   	return Hashids::connection('message')->encode($this->attributes['id']);
   }

   public function getTimeAttribute()
   {
      $time = new Carbon($this->attributes['created_at']);
      return $time->diffForHumans();
   }

   public function getCreateAttribute()
   {
      $create = new Carbon($this->attributes['created_at']);
      return $create->format('');
   }
   public function getSubjectAttribute($value)
   {
      return ucwords($value);
   }

   public function user()
   {
   		return $this->belongsTo('App\User', 'sender', 'id');
   }
   public function sender()
   {
         return $this->belongsTo('App\User', 'to', 'id');
   }
}

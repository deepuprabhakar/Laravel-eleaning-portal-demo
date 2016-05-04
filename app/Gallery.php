<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Gallery extends Model
{
	use SearchableTrait;
	
    protected $table = "gallery";

    protected $fillable = ['image'];

    protected $searchable = [
        'columns' => [
            'gallery.image' => 10,
        ],
    ];
}

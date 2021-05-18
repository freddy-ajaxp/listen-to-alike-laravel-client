<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortened_url extends Model
{
    
    protected $fillable = [
        'full_url' ,'short_url', 'slug'
    ];
    protected $primaryKey = 'id';
    protected $table = 'shortened_urls';
	public $timestamps = true;
}

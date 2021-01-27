<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     	 	
    protected $fillable = [
        'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'notifications';
	public $timestamps = false;
}

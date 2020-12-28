<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    
    protected $fillable = [
        'link_id', 'ip'
    ];
    protected $primaryKey = 'id';
    protected $table = 'visits';
	public $timestamps = true;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    //
    protected $fillable = [
        'text', 'createdAt','updatedAt'
    ];
    protected $primaryKey = 'id';
    protected $table = 'list_text';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

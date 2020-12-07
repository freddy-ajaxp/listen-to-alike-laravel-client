<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List_platform extends Model
{
    //
    protected $fillable = [
        'platform_name', 'logo_image_path', 'platform_regex'
    ];

    protected $primaryKey = 'id';
    protected $table = 'list_platforms';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

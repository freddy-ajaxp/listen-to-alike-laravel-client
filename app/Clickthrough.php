<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clickthrough extends Model
{
    protected $fillable = [
        'link_id', 'link_platform_id','ip'
    ];
    protected $primaryKey = 'id';
    protected $table = 'clickthroughs';
	public $timestamps = true;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link_platform extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'link_platforms';
	public $timestamps = false;
    protected $fillable = [
        'url_platform', 'jenis_platform', 'text', 'id_link'
    ];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


}

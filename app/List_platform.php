<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class List_platform extends Model

{    use SoftDeletes;

    //
    protected $fillable = [
        'platform_name', 'logo_image_path', 'platform_regex', 'admin', 'createdAt','updatedAt'
    ];
    protected $primaryKey = 'id';
    protected $table = 'list_platforms';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';


     public function link_platform()
    {
        return $this->hasOne('App\Link_platform','jenis_platform');
    }


}

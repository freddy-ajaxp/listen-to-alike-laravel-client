<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link_platform extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'link_platforms';
	public $timestamps = false;
    protected $fillable = [
        'url_platform', 'jenis_platform', 'text', 'id_link'
    ];
    protected $dates = ['deletedAt'];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';


    public function list_platform()
    {
        return $this->belongsTo(List_platform::class,'jenis_platform')->withTrashed();
    }

    public function list_text()
    {
        return $this->belongsTo(List_text::class,'text');
    }
}

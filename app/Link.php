<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Link extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'links';
	public $timestamps = false;
    protected $fillable = [
        'image_path', 'title', 'video_embed_url', 'short_link', 'id_user'
    ];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';


    public function link_platform()
    {
        return $this->hasMany(Link_platform::class, 'id_link');
    }
    public function visits()
    {
        return $this->belongsTo(Visit::class, 'link_id');
    }
}

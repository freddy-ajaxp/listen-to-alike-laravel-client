<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reason extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'reason', 'text'
    ];
    protected $primaryKey = 'id';
    protected $table = 'reason';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';
    
    public function reports()
    {
        return $this->belongsToMany('App\Report' );
    }   
}

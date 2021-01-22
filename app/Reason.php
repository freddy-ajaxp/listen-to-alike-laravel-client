<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'reason', 'text'
    ];
    protected $primaryKey = 'id';
    protected $table = 'reason';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function reports()
    {
        return $this->belongsToMany('App\Report' );
    }   
}

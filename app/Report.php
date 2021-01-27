<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'link', 'ip_reporter', 'reason', 'additional_reason', 'validated'
    ];
    protected $primaryKey = 'id';
    protected $table = 'report';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function reasons()
    {
        return $this->belongsToMany('App\Reason');
    } 
    
    public function links()
    {
        return $this->belongsTo('App\Link', 'link');
    }
}

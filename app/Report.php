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
}

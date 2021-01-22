<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason_report extends Model
{
    protected $fillable = [
        'report_id', 'reason_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'reason_report';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

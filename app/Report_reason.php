<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_reason extends Model
{
    protected $fillable = [
        'reason', 'text'
    ];
    protected $primaryKey = 'id';
    protected $table = 'report_reason';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}

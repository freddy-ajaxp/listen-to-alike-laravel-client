<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List_text extends Model
{
    protected $fillable = [
        'text'
    ];
    protected $primaryKey = 'id';
    protected $table = 'list_text';
	public $timestamps = false;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';


    public function list_text()
    {
        return $this->hasOne('App\Link_platform','text');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $table = 'users';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';



}

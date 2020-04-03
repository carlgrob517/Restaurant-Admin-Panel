<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    protected $fillable = array( 'id', 'name', 'email','email_verified_at','password', 'remember_token', 'role', 'phone', 'image');

    public function getName()
    {
        return 'first_name'; // db column name
    }
    
}

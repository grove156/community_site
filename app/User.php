<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    protected $fillable = [
      'name',
      'email',
      'password',
      'confirm_code',
      'activated',
    ];

    protected $hidden = [
      'password',
      'remember_token',
      'confirm_code',
      'last_login',
      'activated',
      'updated_at',
    ];

    protected $casts = [
      'activated' => 'boolean',
    ];

    public function isAdmin()
    {
      return ($this->id === 1 ? true : false);
    }
    //relationship
    public function articles()
    {
      return $this->hasMany(Article::class);
    }

}

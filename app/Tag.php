<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
      'name',
      'slug',
      'ko',
      'en',
    ];
    protected $hidden =[
      'created_at',
      'updated_at',
    ];
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}

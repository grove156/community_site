<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
      'title',
      'content',
      'notification',
      'view_count',
    ];

    protected $hidden = [
      'user_id',
      'notification',
      'deleted_at',
    ];

    protected $with = ['user'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class);
    }

    public function attachments()
    {
      return $this->hasMany(Attachment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
        // return $this->belongsTo(BlogPost::class,'post_id','blog_post_id');
    }
}

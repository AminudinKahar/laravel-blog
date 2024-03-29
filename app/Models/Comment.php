<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
        // return $this->belongsTo(BlogPost::class,'post_id','blog_post_id');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT,'desc');
    }   


    public static function boot() 
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);

    }
}

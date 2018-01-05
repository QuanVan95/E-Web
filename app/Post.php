<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $fillable = [
        'name', 'view', 'order', 'description', 'category_id', 'url', 'image', 'gallery', 'post_date', 'summary', 'meta_title', 'meta_keyword', 'meta_description', 'sub_name', 'active', 'show', 'deleted'
    ];
}

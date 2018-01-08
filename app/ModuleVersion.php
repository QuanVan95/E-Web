<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    public $fillable = [
        'name', 'description', 'version', 'status', 'attribute', 'api', 'created_by', 'updated_by'
    ];
}

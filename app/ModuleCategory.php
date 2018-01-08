<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    public $fillable = [
            'name', 'description', 'created_by', 'updated_by'
    ];
}

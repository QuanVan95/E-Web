<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    public $fillable = [
        'module_cate_id', 'module_version_id', 'created_by', 'updated_by'
    ];
}

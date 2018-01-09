<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleCategory extends Model
{
    protected $table = 'module_categories';
    public $fillable = [
            'name', 'description', 'parent_id', 'created_by', 'updated_by'
    ];
}

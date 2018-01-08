<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleCategory extends Model
{
    protected $table = 'module_categories';
    public $fillable = [
            'name', 'description', 'created_by', 'updated_by'
    ];
}

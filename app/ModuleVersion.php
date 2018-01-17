<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleVersion extends Model
{
    protected $table = 'module_versions';
    public $fillable = [
        'name', 'description', 'version', 'status', 'attribute','module_id', 'api', 'created_by', 'updated_by'
    ];
}

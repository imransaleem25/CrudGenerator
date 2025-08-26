<?php

namespace Imransaleem\CrudGenerator\Models;

use Illuminate\Database\Eloquent\Model;

class CrudStat extends Model
{
    protected $fillable = ['model_name', 'table_name', 'records_count', 'generated_count'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $primaryKey = 'source_id';
    public $incrementing = false;

    protected $fillable = [
        'source_id',
        'source_label',
        'source_link',
        'source_active',
    ];

    public function resource()
    {
        return $this->hasMany('App\Models\Resource', 'resource_source_id');
    }
}

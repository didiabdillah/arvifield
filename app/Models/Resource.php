<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $primaryKey = 'resource_id';
    public $incrementing = false;

    protected $fillable = [
        'resource_id',
        'resource_category_id',
        'resource_source_id',
        'resource_label',
        'resource_slug',
        'resource_desc',
        'resource_link',
        'resource_preview',
        'resource_active',
    ];

    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'resource_source_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'resource_category_id');
    }
}

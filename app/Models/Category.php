<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'category_label',
        'category_slug',
    ];

    public function resource()
    {
        return $this->hasMany('App\Models\Resource', 'resource_category_id');
    }
}

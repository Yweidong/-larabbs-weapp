<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = [
                   'image'
    ];
    protected $casts = [
        'on_show' => 'boolean', // on_show 是一个布尔类型的字段
    ];
}

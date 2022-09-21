<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $table = 'activities';
    protected $casts = [
        'start' => 'date',
        'finish' => 'date',
    ];
    protected $fillable = [
        'method_id',
        'title',
        'start',
        'finish',
    ];
    protected $dates = ['deleted_at'];
}

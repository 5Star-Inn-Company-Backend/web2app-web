<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class convert extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'email',
        'plan',
        // 'plan1',
        // 'plan2',
        // 'plan3',
        'appname',
        'icon',
        'fullscreen',
        'primarycolor',
        'packagename',
        'admob',
        'admobID',
        'status',
        'reference_code',
        'app_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class App extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'branding' => 'array',
        'link_handling' => 'array',
        'interface' => 'array',
        'website_overide' => 'array',
        'permission' => 'array',
        'navigation' => 'array',
        'notification' => 'array',
        'plugin' => 'array',
        'build_setting' => 'array',
    ];


    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

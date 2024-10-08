<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'user_id',
        'role_id',
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

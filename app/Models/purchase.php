<?php

namespace App\Models;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';

    protected $fillable = [
        'name',
        'email',
        'store_id',
        'price',
        'reference_code',
    ];

    /**
     * Get the store that owns the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}

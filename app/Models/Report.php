<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'website_id',
        'revenue',
        'impressions',
        'clicks',
        'date'
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}

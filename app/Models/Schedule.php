<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_range_id',
        'day',
        'starts_at',
        'ends_at',
    ];

    public function date()
    {
        return$this->belongsTo(DateRange::class);
    }
}

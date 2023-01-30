<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateRange extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

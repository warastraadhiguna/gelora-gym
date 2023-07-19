<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function operationalTime()
    {
        return $this->belongsTo(OperationalTime::class);
    }

    public function weeklyBookingDetails()
    {
        return $this->hasMany(WeeklyBookingDetail::class);
    }

    public function receiptDetail()
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}

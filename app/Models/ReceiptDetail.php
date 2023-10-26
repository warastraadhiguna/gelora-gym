<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiptDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public static function getBooked($nowTime)
    {
        $sql = "SELECT * FROM receipt_details a inner join receipts b on a.receipt_id=b.id where booking_date>='" . DateFormat($nowTime, "YYYY/MM/DD") . "' and (b.status > 0 or TIMESTAMPDIFF(SECOND, b.created_at, now()) <= 600)";
        //     dd($sql);
        return DB::select($sql);
    }
}

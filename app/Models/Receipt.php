<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function receiptDetails()
    {
        return $this->hasMany(ReceiptDetail::class);
    }


}

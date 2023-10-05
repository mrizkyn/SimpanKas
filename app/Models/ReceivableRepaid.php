<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivableRepaid extends Model
{
    protected $fillable = ['account_id', 'debt_recipient', 'receive_nominal', 'payment_date', 'receive_desc', 'date'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}

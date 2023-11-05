<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{
    protected $fillable = ['account_id', 'debt_recipient', 'receive_nominal', 'payment_date', 'receive_desc', 'date', 'noted_by'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}

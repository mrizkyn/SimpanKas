<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
      protected $fillable = ['account_id', 'creditor', 'debt_nominal', 'due_date', 'debt_desc', 'date', 'noted_by'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}

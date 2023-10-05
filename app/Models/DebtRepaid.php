<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtRepaid extends Model
{
    protected $fillable = ['account_id', 'creditor', 'debt_nominal', 'due_date', 'debt_desc', 'date'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['account_id', 'descrription', 'total', 'date'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function Income(){
        return $this->hasMany(Income::class);
    }
    public function Debt(){
        return $this->hasMany(Debt::class);
    }
    public function Receivable(){
        return $this->hasMany(Receivable::class);
    }
    public function Expenditure(){
        return $this->hasMany(Expenditure::class);
    }
}

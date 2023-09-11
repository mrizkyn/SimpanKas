<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $fillable = ['account_id', 'category_exp', 'nominal_exp', 'exp_desc', 'date','asset_period','annual_dep','dep_month'];

    public function Account(){
        return $this->belongsTo(Account::class);
    }

}

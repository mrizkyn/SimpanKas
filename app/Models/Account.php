<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
   
    protected $fillable = ['parent_id', 'code', 'name'];
    
    protected $table = 'accounts';


    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
        
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

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

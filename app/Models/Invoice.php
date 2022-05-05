<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    public function purchases()
    {
        return $this->hasMany(Purchase::class)->where('invoice_id', '=',$this->id);
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id')->first();
    }

}

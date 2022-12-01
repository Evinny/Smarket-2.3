<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'details', 'price', 'amount_stocked', 'amount_in_markets', 'providers_id'];

    public function Provider(){
        return $this->hasone('App/Models/Provider');
    }
}

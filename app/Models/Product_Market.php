<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Market extends Model
{
    use HasFactory;
    protected $table = 'products_markets';
    protected $fillable = ['produto_id', 'market_id', 'amount_requested', 'amount_sold', 'amount_left'];
}

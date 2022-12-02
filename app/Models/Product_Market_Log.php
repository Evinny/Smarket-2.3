<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Market_Log extends Model
{
    use HasFactory;
    protected $fillable = ['produto_id', 'market_id', 'amount_requested', 'total_price', 'amount_left'];
    protected $table = 'product_market_logs';


}

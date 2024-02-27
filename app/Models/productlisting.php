<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productlisting extends Model
{
    use HasFactory;

    protected $table = 'productlistings';

    protected $fillable = ['product_name', 'description', 'product_brief', 'price', 'discount_price', 'category', 'sub_category', 'quantity'];
}

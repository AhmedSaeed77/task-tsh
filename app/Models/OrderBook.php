<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderBook extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_books';

    protected $fillable = ['order_id','book_id','quantity','price'];
}

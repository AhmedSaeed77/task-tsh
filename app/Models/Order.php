<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['order_number','user_id','total_price','status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            do
            {
                $orderNumber = 'ORD-' . strtoupper(Str::random(10));
            }
            while (self::where('order_number', $orderNumber)->exists());

            $order->order_number = $orderNumber;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_books', 'order_id', 'book_id')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}

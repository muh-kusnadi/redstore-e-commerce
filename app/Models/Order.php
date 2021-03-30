<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['product_id', 'user_id', 'quantity', 'size','total', 'is_checkout'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart($user_id)
    {
        return $this->where([
            'user_id'       => $user_id,
            'is_checkout'   => 0
        ])->get();
    }
}

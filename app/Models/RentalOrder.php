<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalOrder extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $table = 'rental_order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'extention_days',
        'cost_per_day',
        'subtotal',
        'itbms',
        'total',
        'payment',
        'code',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class,'order_detail', 'rental_order_id', 'car_id')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

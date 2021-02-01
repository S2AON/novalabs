<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y-m-d H:m:s';

    protected $table = 'car';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'model',
        'chasis',
        'category',
        'transmission',
        'passenger_capacity',
        'trunk_capacity',
        'features',
        'description',
        'price',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsToMany(OrderDetail::class)->withTimestamps();
    }
}

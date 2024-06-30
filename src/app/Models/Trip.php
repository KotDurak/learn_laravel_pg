<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property $id
 * @property $route
 * @property $description
 * @property $status
*/
class Trip extends Model
{
    use HasFactory;

    protected $attributes = [
        'status'    => 'new',
    ];

    protected $casts = [
        'route' => 'array'
    ];

    /*protected function route(): Attribute
    {
        return Attribute::make(
            get: fn($route) => json_decode($route),
        );
    }

    protected function points(): Attribute
    {
        return Attribute::make(
          get: fn() => 'simple points',
        );
    }*/
}

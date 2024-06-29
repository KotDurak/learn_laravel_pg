<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

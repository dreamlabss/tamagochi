<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Модель тамагочи 
 * 
 * @property int $id ID 
 * @property string $name Имя
 * @property int $health Здоровье
 * @property int $hunger Голод
 * @property int $fatigue Усталость
 * @property string $api_token Токен
 */
class Tamagochi extends Authenticatable
{
    protected $table = 'tamagochies';

    protected $hidden = [
        'api_token'
    ];
}

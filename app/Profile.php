<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Profile extends Model
{

    protected $fillable = ['field_string', 'field_decimal', 'field_json'];

    // Custom Cast Types + Object / Value Object Casts 
    public $casts = [
        'field_string' => StringCast::class,
        'field_decimal' => NumberCast::class,
        'field_json' => AddressCast::class,
    ];

    /**
     * Date Serialization (set date format)
     */
    public function serializeDate(DateTimeInterface $date){
        return $date->format('d-m-y h:i:s');
    }
}

class StringCast implements CastsAttributes
{
    /**
     * get array value
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    /**
     * set array value into string
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return implode(' ', $value);
    }
}

class NumberCast implements CastsAttributes
{
    /**
     * get number value and devide into 100
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value / 100;
    }

    /**
     * set number
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}


class AddressCast implements CastsAttributes
{

    /**
     * get array and decode json
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return json_decode($value, true);
    }

    /**
     * set json and encode json
     * @param $model, string $key, $value, array $attributes
     * @return $value
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value, true);
    }
}

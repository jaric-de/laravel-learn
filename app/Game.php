<?php

/**
 * An Eloquent Model: 'Game'
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Game extends \Eloquent
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'platform',
        'genre',
        'price',
        'duration',
        'release_year'
    ];

    public static function scopeFilter(Builder $query, $filters)
    {
        if (isset($filters['platform'])) {
            $query->where('platform', $filters['platform']); // whereMonth expect 5, not May
        }

        if (isset($filters['price'])) {
            $query->orderBy('price', $filters['price']);
        }

        return $query;
    }

    public static function scopeUnactive(Builder $query)
    {
        $query->where('is_active', false);

        return $query;
    }
}

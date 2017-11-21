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

    /**
     * @param Builder $query
     * @param $platformVal
     * @return Builder
     */
    public static function scopePlatformFilter(Builder $query, $platformVal)
    {
        if (isset($platformVal)) {
            $query->where('platform', $platformVal);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param $sortType
     * @return Builder
     */
    public static function scopePriceSort(Builder $query, $sortType)
    {
        if (isset($sortType)) {
            $query->orderBy('price', $sortType);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public static function scopeInactive(Builder $query)
    {
        $query->where('is_active', false);

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

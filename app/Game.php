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
    public $fff;
}

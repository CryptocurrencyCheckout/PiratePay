<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'platform', 'client', 'secret', 'link',
    ];
}

<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
    /**
     * Boot the Uuids trait for a model.
     *
     * @return void
     */
    protected static function bootUuids()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait IdentifierFields
{
    public static function bootIdentifierFields()
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (auth()->user()) {

                $id = auth()->user()->pessoa()->id;

                if (!$model->isDirty('created_by')) {
                    $model->created_by = $id;
                }
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = $id;
                }
            }
            if (!$model->isDirty('uuid')) {
                $model->uuid =  Str::uuid()->toString();
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if(auth()->user()) {

                $id = auth()->user()->pessoa()->id;

                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = $id;
                }
            }
        });
    }
}

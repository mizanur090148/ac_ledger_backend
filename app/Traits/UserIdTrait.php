<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait UserIdTrait {

    protected static function bootUserIdTrait()
    {
        static::addGlobalScope('UserId', function (Builder $builder) {
            if (Auth::user()->role_id == 3) {
                $builder->where('created_by', Auth::id());
            }
        });

        static::creating(function ($model) {
            if (in_array('created_by', $model->getFillable())) {
                $model->created_by = Auth::id();
            }
        });

        static::saving(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            if (in_array('updated_by', $model->getFillable())) {
                DB::table($model->table)->where('id', $model->id)->update([
                    'updated_by' => Auth::id()
                ]);
            }
        });

        static::deleting(function ($model) {
            if (in_array('deleted_by', $model->getFillable())) {
                DB::table($model->table)->where('id', $model->id)
                    ->update([
                        'deleted_by' => Auth::id()
                    ]);
            }
        });
    }
}
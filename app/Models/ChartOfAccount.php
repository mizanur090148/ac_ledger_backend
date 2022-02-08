<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartOfAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'title',
        'parent_id',
        'type',
        'last_child',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|mixed
     */
    public function chartOfAccounts()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /*public function parent()
    {
        return $this->belongsTo(self::class)->withDefault();
    }*/

    public function childChartOfAccounts()
    {
        return $this->hasMany(self::class, 'parent_id')->with('childChartOfAccounts');
    }
}

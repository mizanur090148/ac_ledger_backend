<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartOfAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'title',
        'ac_code',
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
     * @return HasMany|mixed
     */
    public function chartOfAccounts()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->select('id','parent','type','ac_code','title as text');
    }

    /**
     * @return HasMany
     */
    public function nodes()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->select('id','parent_id','type','ac_code','title as text','last_child')
            ->with('nodes:id,parent_id,type,ac_code,last_child,title as text');
    }
}

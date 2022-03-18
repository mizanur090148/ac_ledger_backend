<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'company_id',
        'name',
        'short_name',
        'address_one',
        'address_two',
        'concerned_person',
        'email',
        'contact_no',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $appends = [
        'company_name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return string
     */
    public function getCompanyNameAttribute()
    {
        return $this->company->name ?? '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

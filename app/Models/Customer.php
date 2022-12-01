<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    // use HasFactory;
    protected $table = 'customers';

    protected $keyType = 'string';
    protected $fillable = [
        'branch_id',
        'customer_id',
        'name',
        'address',
        'geolocation',
        'class',
        'email',
        'identity_type',
        'identity_number',
        'npwp_number',
        'npwp_files',
        'phone_number',
        'company_name',
        'company_address',
        'company_npwp',
        'company_npwp_files',
        'company_sppkp',
        'company_sppkp_files',
        'company_phone_number',
        'company_employees',
        'survey_id',
        'extend_note',
        'reference_id',
        'assigned_sales_manager'
    ];

    public function billing()
    {
        return $this->hasOne(Billing::class, 'id', 'id');
    }

    public function technical()
    {
        return $this->hasOne(Technical::class, 'id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class, 'id', 'id');
    }

    public function scopeFiltered(Builder $builder): Builder
    {
        return $builder
            ->leftJoin('users', "{$this->table}.reference_id", 'users.employee_id')
            ->select(
                "{$this->table}.*",
                DB::raw("IF({$this->table}.assigned_sales_manager IS NULL, users.under_employee_id, {$this->table}.assigned_sales_manager) AS reference_sm")
            )
            ->havingRaw('reference_sm IS NOT NULL');
    }
}

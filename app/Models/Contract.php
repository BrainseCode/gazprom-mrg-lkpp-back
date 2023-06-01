<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'number',
        'name',
        'reporting_hour',
        'registration_date',
        'start_date',
        'end_date',
        'arrears',
        'request_approval_unevenness_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'registration_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function connectionPoints()
    {
        return $this->hasMany(ConnectionPoint::class);
    }

    public function allIndicationQuarters()
    {
        return $this->hasMany(AllIndicationQuarter::class);
    }

    public function payGasDelivereds()
    {
        return $this->hasMany(PayGasDelivered::class);
    }

    public function payGasPlanneds()
    {
        return $this->hasMany(PayGasPlanned::class);
    }

    public function payTovdgos()
    {
        return $this->hasMany(PayTovdgo::class);
    }

    public function payTotals()
    {
        return $this->hasMany(PayTotal::class);
    }

    public function calorieArchives()
    {
        return $this->hasMany(CalorieArchive::class);
    }

    public function requestApprovalUnevenness()
    {
        return $this->belongsTo(RequestApprovalUnevenness::class);
    }

    public function contractTypes()
    {
        return $this->belongsToMany(ContractType::class);
    }

    public function contractStatuses()
    {
        return $this->belongsToMany(ContractStatus::class);
    }
}

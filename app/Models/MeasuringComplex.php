<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeasuringComplex extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['connection_point_id', 'number'];

    protected $searchableFields = ['*'];

    protected $table = 'measuring_complexes';

    public function connectionPoint()
    {
        return $this->belongsTo(ConnectionPoint::class);
    }

    public function meter()
    {
        return $this->hasOne(Meter::class);
    }

    public function pressureGauge()
    {
        return $this->hasOne(PressureGauge::class);
    }

    public function thermometer()
    {
        return $this->hasOne(Thermometer::class);
    }

    public function calculator()
    {
        return $this->hasOne(Calculator::class);
    }

    public function powerUnit()
    {
        return $this->hasOne(PowerUnit::class);
    }

    public function transferIndications()
    {
        return $this->hasMany(TransferIndication::class);
    }
}

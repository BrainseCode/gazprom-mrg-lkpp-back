<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConnectionPoint extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['contract_id', 'address'];

    protected $searchableFields = ['*'];

    protected $table = 'connection_points';

    public function measuringComplex()
    {
        return $this->hasOne(MeasuringComplex::class);
    }

    public function gasConsumingEquipments()
    {
        return $this->hasMany(GasConsumingEquipment::class);
    }

    public function indications()
    {
        return $this->hasMany(Indication::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function indicationQuarters()
    {
        return $this->hasMany(IndicationQuarter::class);
    }
}

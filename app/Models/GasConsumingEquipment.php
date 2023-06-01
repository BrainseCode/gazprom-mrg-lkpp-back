<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GasConsumingEquipment extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'connection_point_id',
        'name',
        'quantity',
        'power',
        'consumption',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'gas_consuming_equipments';

    public function connectionPoint()
    {
        return $this->belongsTo(ConnectionPoint::class);
    }
}

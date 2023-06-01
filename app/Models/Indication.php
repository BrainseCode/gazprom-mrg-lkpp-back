<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indication extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['connection_point_id', 'date', 'volume', 'plan'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function connectionPoint()
    {
        return $this->belongsTo(ConnectionPoint::class);
    }

    public function indicationStatuses()
    {
        return $this->belongsToMany(IndicationStatus::class);
    }

    public function indicationSources()
    {
        return $this->belongsToMany(IndicationSource::class);
    }
}

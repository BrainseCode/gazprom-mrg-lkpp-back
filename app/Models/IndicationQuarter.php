<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndicationQuarter extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'connection_point_id',
        'date_year',
        'year',
        'quarter_1',
        'quarter_2',
        'quarter_3',
        'quarter_4',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'indication_quarters';

    public function connectionPoint()
    {
        return $this->belongsTo(ConnectionPoint::class);
    }
}

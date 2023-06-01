<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferIndication extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'measuring_complex_id',
        'date',
        'indication',
        'value',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transfer_indications';

    protected $casts = [
        'date' => 'date',
    ];

    public function measuringComplex()
    {
        return $this->belongsTo(MeasuringComplex::class);
    }
}

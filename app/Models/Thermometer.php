<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thermometer extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'measuring_complex_id',
        'name',
        'number',
        'verification_date',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'verification_date' => 'date',
    ];

    public function measuringComplex()
    {
        return $this->belongsTo(MeasuringComplex::class);
    }
}

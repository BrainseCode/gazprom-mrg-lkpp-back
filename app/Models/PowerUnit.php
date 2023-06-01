<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PowerUnit extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['measuring_complex_id', 'name', 'number'];

    protected $searchableFields = ['*'];

    protected $table = 'power_units';

    public function measuringComplex()
    {
        return $this->belongsTo(MeasuringComplex::class);
    }
}

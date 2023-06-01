<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnallocatedByDate extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['date', 'gas_volume'];

    protected $searchableFields = ['*'];

    protected $table = 'unallocated_by_dates';

    protected $casts = [
        'date' => 'date',
    ];

    public function requestApprovalUnevennesses()
    {
        return $this->belongsToMany(RequestApprovalUnevenness::class);
    }
}

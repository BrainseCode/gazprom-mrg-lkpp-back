<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestApprovalUnevenness extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'gas_volume',
        'gas_volume_unallocated',
        'total',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'request_approval_unevennesses';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function unallocatedByDates()
    {
        return $this->belongsToMany(UnallocatedByDate::class);
    }
}

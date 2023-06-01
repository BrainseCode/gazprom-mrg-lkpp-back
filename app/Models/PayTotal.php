<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayTotal extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'pay_delivered',
        'pay_planned',
        'pay_tovdgo',
        'total',
        'total_nds',
        'contract_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'pay_totals';

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}

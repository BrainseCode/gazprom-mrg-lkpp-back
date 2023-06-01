<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayTovdgo extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['date', 'summ', 'status_pay', 'contract_id'];

    protected $searchableFields = ['*'];

    protected $table = 'pay_tovdgos';

    protected $casts = [
        'date' => 'date',
        'status_pay' => 'boolean',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}

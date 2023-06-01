<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UniversalRequest extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'message', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'universal_requests';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

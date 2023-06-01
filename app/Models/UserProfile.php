<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'short_name',
        'full_name',
        'responsible_person',
        'shared_phone',
        'responsible_phone',
        'legal_address',
        'postal_address',
        'inn',
        'kpp',
        'ogrn',
        'okpo',
        'okfs',
        'okato',
        'okopf',
        'oktmo',
        'okved',
        'okogu',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'user_profiles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

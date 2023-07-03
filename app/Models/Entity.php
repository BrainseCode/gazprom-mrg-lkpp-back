<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \App\Models\EntityType;
use \App\Models\EntityData;

class Entity extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['id', 'type_id', 'struct'];

    protected $searchableFields = ['*'];

    public function entityType()
    {
        return $this->belongsTo(EntityType::class);
    }
    public function entityData()
    {
        return $this->belongsTo(EntityData::class);
    }
}

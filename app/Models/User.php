<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function universalRequests()
    {
        return $this->hasMany(UniversalRequest::class);
    }

    public function requestApprovalUnevennesses()
    {
        return $this->hasMany(RequestApprovalUnevenness::class);
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function requestCallEmployees()
    {
        return $this->hasMany(RequestCallEmployee::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}

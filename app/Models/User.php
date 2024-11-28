<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
{

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * Get the identifier that will be stored in the JWT payload.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Ensure that password is hashed before saving it
    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->password) {
                $user->password = Hash::make($user->password);
            }
        });
    }
}

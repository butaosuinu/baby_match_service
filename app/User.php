<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Request;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'is_babysitter'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function contracts()
    {
        return $this->belongsToMany(Request::class, 'contracts', 'contractor_id', 'request_id')->withTimestamps();
    }

    public function contract($requestId)
    {
        $exist = $this->is_contract($requestId);

        if ($exist) {
            return false;
        } else {
            $this->contracts()->attach($requestId);
            return true;
        }
    }

    public function uncontract($requestId)
    {
        $exist = $this->is_contract($requestId);
        
        if ($exist) {
            $this->contracts()->detach($requestId);
            return true;
        } else {
            return false;
        }
    }

    public function is_contract($requestId)
    {
        return $this->contracts()->where('request_id', $requestId)->exists();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
	protected $fillable = ['user_id', 'area', 'day'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contracteds()
    {
        return $this->belongsToMany(User::class, 'contracts', 'request_id', 'contractor_id')->withTimestamps();
    }

    public function is_contracted($userId)
    {
    	return $this->contracteds()->where('contractor_id', $userId)->exists();
    }
}

<?php

namespace Krutyosila\Authentications\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthentication extends Model
{
    protected $fillable = [
        'user_id', 'ip_address', 'country', 'country_code', 'user_agent', 'ua_parsed'
    ];

    protected $casts = [
        'ua_parsed' => 'object'
    ];
    
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}

<?php

namespace Krutyosila\Authentications\Traits;

use Krutyosila\Authentications\Models\UserAuthentication;

trait UserAuthenticationTrait
{
    public function authentications()
    {
        return $this->hasOne(UserAuthentication::class);
    }
}

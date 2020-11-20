### Laravel Login Authentications Log with Country


Installation
-
``` 
composer require krutyosila/authentications
```

```
php artisan vendor:publish --provider="Krutyosila\Authentications\AuthenticationsProvider"
php artisan migrate
```

Usage
-
Add WalletTrait to Users Model
```
use Krutyosila\Authentications\Traits\UserAuthenticationTrait

class User exteds Model
{
    use UserAuthenticationTrait;
    ...
```

**Authentications Logs**
```
$user->authentications();
```

return with useragent parsed data.



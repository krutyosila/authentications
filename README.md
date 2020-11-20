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

response example
```
    "id" => 1
    "user_id" => 3
    "ip_address" => "::1"
    "country" => "Turkey"
    "country_code" => "TR"
    "user_agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36"
    "ua_parsed" => "{"os": {"major": "10", "minor": "15", "patch": "7", "family": "Mac OS X", "patchMinor": null}, "ua": {"major": "86", "minor": "0", "patch": "4240", "family": "Chrome"}, "device": {"brand": "Apple", "model": "Mac", "family": "Mac"}, "originalUserAgent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36"} ◀"
    "created_at" => "2020-11-20 22:47:14"
    "updated_at" => "2020-11-20 22:47:14"
```

example model for last logins

Add User Model
```
public function lastAuthentications($limit = 5)
{
    return $this->authentications()->orderBy('created_at', 'DESC')->simplePaginate($limit);
}
```





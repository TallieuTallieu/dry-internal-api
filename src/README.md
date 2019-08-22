# dry-internal-api
### An internal API for your DRY applications

#### Installation

```ssh
composer require reinvanoyen/dry-internal-api
```

#### Example usage

```php
<?php

use Tnt\InternalApi\Facade\Api;

Api::get('posts/', '\\Acme\\Controller\\PostController::index');
Api::post('posts/(?<postId>\d+)/', '\\Acme\\Controller\\PostController::add');
Api::delete('posts/(?<postId>\d+)/', '\\Acme\\Controller\\PostController::delete');

```

# dry-internal-api
### An internal API for your DRY applications

#### Installation

```ssh
composer require reinvanoyen/dry-internal-api
```

#### Example usage

##### Route definition

```php
<?php

use Tnt\InternalApi\Facade\Api;

Api::get('posts/', '\\Acme\\Controller\\PostController::index');
Api::post('posts/', '\\Acme\\Controller\\PostController::add');
Api::delete('posts/(?<postId>\d+)/', '\\Acme\\Controller\\PostController::delete');

```
##### Controller

```php
<?php

namespace Acme\Controller;

use Tnt\InternalApi\Exception\ApiException;
use Tnt\InternalApi\Http\Request;

class ApiController
{
	public static function index(Request $request)
	{
    		return [
      			[
				'id' => 1,
				'title' => 'My example post',
			],
			[
				'id' => 2,
				'title' => 'Another example post',
			],
		];
	}
  
	public static function add(Request $request)
	{
		// Create your post
	}

	public static function delete(Request $request)
	{
		if ($request->data->integer('postId')) {
			// Delete your post
			return true;
    		}
		throw new ApiException('post_not_found');
	}
}
```

<?php

namespace Tnt\InternalApi\Http;

class Response
{
	/**
	 * @var array $dumped
	 */
	public static $dumped = [];

	/**
	 * @param $value
	 */
	public static function dump($value)
	{
		self::$dumped[] = json_encode($value);
	}
}
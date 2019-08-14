<?php

namespace Tnt\InternalApi\Exception;

class ApiException extends \Exception
{
	/**
	 * @var string $code
	 */
	public $code;

	/**
	 * @var $data
	 */
	public $data;

	/**
	 * Exception constructor.
	 * @param string $code
	 * @param null $data
	 */
	public function __construct(string $code, $data = null)
	{
		$this->code = $code;
		$this->data = $data;
	}
}
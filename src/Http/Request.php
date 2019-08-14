<?php

namespace Tnt\InternalApi\Http;

use Tnt\InternalApi\Exception\ApiException;

/**
 * Class Request
 * @package Tnt\InternalApi
 */
class Request
{
	/**
	 * @var string $path
	 */
	private $path;

	/**
	 * @var \dry\internals\http\RequestDataWrapper $data
	 */
	public $data;

	/**
	 * @var string $method
	 */
	private $method;

	/**
	 * Request constructor.
	 * @param \dry\http\Request $request
	 */
	public function __construct(\dry\http\Request $request)
	{
		$this->path = $request->parameters->string('path').'/';
		$this->method = $request->method;

		$methodMap = [
			'POST' => 'post',
			'GET' => 'get',
		];

		if (isset($methodMap[$request->method])) {
			$this->data = $request->{$methodMap[$request->method]};
		}
	}

	/**
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->method;
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @param array $required_parameters
	 * @param array $optional_parameters
	 * @throws ApiException
	 */
	public function validate($required_parameters = [], $optional_parameters = [])
	{
		foreach ($required_parameters as $param_name) {
			if (! $this->data->has($param_name)) {
				throw new ApiException('missing_required_parameter', $param_name);
			}
		}
	}
}
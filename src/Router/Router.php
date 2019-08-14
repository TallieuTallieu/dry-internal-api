<?php

namespace Tnt\InternalApi\Router;

use Tnt\InternalApi\Exception\ApiException;
use Tnt\InternalApi\Http\Request;

/**
 * Class ApiRouter
 * @package Tnt\InternalApi
 */
class Router
{
	/**
	 * @var array $get
	 */
	public $get = [];

	/**
	 * @var array $post
	 */
	public $post = [];

	/**
	 * @var array $put
	 */
	public $put = [];

	/**
	 * @var array $delete
	 */
	public $delete = [];

	/**
	 * @param $pattern
	 * @param $controller
	 */
	public function get(string $pattern, $controller)
	{
		$this->get[$pattern] = $controller;
	}

	/**
	 * @param $pattern
	 * @param $controller
	 */
	public function post(string $pattern, $controller)
	{
		$this->post[$pattern] = $controller;
	}

	/**
	 * @param $pattern
	 * @param $controller
	 */
	public function put(string $pattern, $controller)
	{
		$this->put[$pattern] = $controller;
	}

	/**
	 * @param $pattern
	 * @param $controller
	 */
	public function delete(string $pattern, $controller)
	{
		$this->delete[$pattern] = $controller;
	}

	/**
	 * @return array
	 */
	public function getRoutes(): array
	{
		return [
			'GET' => $this->get,
			'POST' => $this->post,
			'PUT' => $this->put,
			'DELETE' => $this->delete,
		];
	}

	/**
	 * @param $request
	 */
	public function route(\dry\http\Request $request)
	{
		$request = new Request($request);

		$map = [
			'GET' => $this->get,
			'POST' => $this->post,
			'PUT' => $this->put,
			'DELETE' => $this->delete,
		];

		$routes = [];

		if (isset($map[$request->getMethod()])) {
			$routes = $map[$request->getMethod()];
		}

		$return = null;

		foreach ($routes as $pattern => $controller) {
			if (preg_match('#^('.$pattern.')$#', $request->getPath(), $m)) {
				$request->parameters = new \dry\internals\http\RequestDataWrapper($m);

				try
				{
					$return = [
						'success' => true,
						'result' => call_user_func($controller, $request),
					];

					break;
				}
				catch (ApiException $e)
				{
					$return = [
						'success' => false,
						'error_code' => $e->getCode(),
					];
				}
			}
		}

		if ($return === null) {
			$return = [
				'success' => false,
				'error_code' => 'invalid_action',
			];
		}

		\dry\http\Response::set_content_type(\dry\http\Response::APPLICATION_JSON);
		echo json_encode($return);
	}
}
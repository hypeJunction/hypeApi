<?php

namespace hypeJunction\Api;

use Elgg\Request;

class ApiMiddleware {

	public function __invoke(Request $r) {
		$request = _elgg_services()->request;

		//elgg_set_viewtype('json');

		elgg_set_http_header('Content-Type: application/json;charset=UTF-8');
		elgg_set_http_header('Access-Control-Allow-Origin: *');
		elgg_set_http_header('Access-Control-Allow-Headers: authorization,content-type,x-requested-with');
		elgg_set_http_header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST');

		if (strtolower($request->getMethod()) == 'options') {
			return elgg_ok_response([
				'message' => 'Hello',
			]);
		}

		$content = $request->getContent();

		if ($content && $request->getContentType() == 'json') {
			$data = json_decode($content, true);

			foreach ($data as $key => $value) {
				$request->setParam($key, $value, true);
			}
		}
	}
}
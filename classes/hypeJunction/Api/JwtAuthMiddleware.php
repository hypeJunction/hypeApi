<?php

namespace hypeJunction\Api;

use Elgg\Http\Exception\AjaxGatekeeperException;
use Elgg\HttpException;
use Elgg\Request;

class JwtAuthMiddleware {

	/**
	 * @throws HttpException
	 * @throws \LoginException
	 */
	public function __invoke(Request $r) {
		if (elgg_is_logged_in()) {
			throw new AjaxGatekeeperException();
		}

		$request = _elgg_services()->request;

		$user = Security::validateRequest($request);

		if (!$user) {
			throw new HttpException('Invalid credentials', ELGG_HTTP_UNAUTHORIZED);
		}

		login($user);
	}
}
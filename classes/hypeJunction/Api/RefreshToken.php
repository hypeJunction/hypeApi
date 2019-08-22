<?php

namespace hypeJunction\Api;

use Elgg\GatekeeperException;

class RefreshToken {

	public function __invoke() {
		$user = elgg_get_logged_in_user_entity();

		if (!$user) {
			throw new GatekeeperException();
		}

		return elgg_ok_response([
			'token' => Security::generateToken(['guid' => $user->guid]),
			'user' => $user->toObject([
				'context' => 'api',
			]),
		]);
	}
}
<?php

namespace hypeJunction\Api;

use Elgg\Request;

class Logout {

	public function __invoke(Request $request) {
		logout();

		return elgg_ok_response([]);
	}
}
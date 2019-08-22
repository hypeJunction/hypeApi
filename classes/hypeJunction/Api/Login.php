<?php

namespace hypeJunction\Api;

use Elgg\HttpException;
use Elgg\Request;
use hypeJunction\Data\CollectionItemAdapter;

class Login {

	/**
	 * @param Request $request
	 *
	 * @return \Elgg\Http\OkResponse
	 * @throws HttpException
	 */
	public function __invoke(Request $request) {
		$username = $request->getParam('username');
		$password = $request->getParam('password');

		try {
			$result = elgg_authenticate($username, $password);

			if ($result !== true) {
				throw new HttpException('Invalid credentials', ELGG_HTTP_FORBIDDEN);
			}

			$user = get_user_by_username($username);

			$adapter = new CollectionItemAdapter($user);

			return elgg_ok_response([
				'token' => Security::generateToken(['guid' => $user->guid]),
				'user' => $adapter->export(),
			]);
		} catch (\Exception $ex) {
			throw new HttpException('Invalid credentials', ELGG_HTTP_FORBIDDEN);
		}
	}
}
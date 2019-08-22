<?php

namespace hypeJunction\Api;

use Elgg\Http\Request;
use Firebase\JWT\JWT;

class Security {

	/**
	 * Generate JWT token
	 *
	 * @return string
	 *
	 * @throws \Exception
	 */
	public static function generateToken(array $payload = [], $exp = '+1 hour') {
		$time = time();

		$guid = elgg_extract('guid', $payload);

		$payload = array_merge($payload, [
			'iss' => elgg_get_site_url(),
			'sub' => $guid ? : elgg_get_logged_in_user_guid(),
			'iat' => $time,
			'exp' => strtotime($exp, $time),
		]);

		$key = _elgg_services()->siteSecret->get();

		return JWT::encode($payload, $key);
	}

	/**
	 * Validate JWT token
	 *
	 * @param string $token Token
	 *
	 * @return \ElggUser|false
	 */
	public static function validateToken($token) {
		$key = _elgg_services()->siteSecret->get();

		$decoded = JWT::decode($token, $key, ['HS256']);

		$guid = $decoded->sub;

		return get_user($guid);
	}

	/**
	 * Validate JWT token in request header
	 *
	 * @param Request $request Request
	 * @return \ElggUser|false
	 */
	public static function validateRequest(Request $request) {
		$auth_header = $request->headers->get('Authorization');

		if (!$auth_header) {
			return false;
		}

		list($type, $token) = explode(' ', $auth_header);

		if ($type !== 'Bearer') {
			return false;
		}

		return self::validateToken($token);
	}
}
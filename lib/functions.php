<?php

/**
 * Check Authorization header for JWT tokens
 *
 * @param array $credentials Credentials
 * @return
 */
function elgg_jwt_pam_handler(array $credentials = []) {
	$request = _elgg_services()->request;

	$user = \hypeJunction\Api\Security::validateRequest($request);

	if (!$user) {
		return false;
	}

	return true;
}
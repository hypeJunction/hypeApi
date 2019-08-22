<?php

namespace hypeJunction\Api;

use Elgg\PluginBootstrap;

class Bootstrap extends PluginBootstrap {

	public function load() {
		require_once $this->plugin->getPath() . 'lib/functions.php';
	}

	public function boot() {

	}

	public function init() {
		register_pam_handler('elgg_jwt_pam_handler');
	}

	public function ready() {

	}

	public function shutdown() {

	}

	public function activate() {

	}

	public function deactivate() {

	}

	public function upgrade() {

	}
}
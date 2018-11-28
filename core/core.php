<?php

// Subpackage namespace
namespace LittleBizzy\LimitHeartbeat\Core;

// Aliased namespaces
use \LittleBizzy\LimitHeartbeat\Helpers;

/**
 * Core class
 *
 * @package Limit Heartbeat
 * @subpackage Core
 */
final class Core extends Helpers\Singleton {



	/**
	 * Pseudo constructor
	 */
	protected function onConstruct() {

		// WP init hook
		add_action('wp_print_scripts', [$this, 'scripts'], PHP_INT_MAX);
	}



	/**
	 * Handle WP init hook
	 */
	public function scripts() {

		// Check enqueued script
		if (wp_script_is('heartbeat')) {

			// Factory object
			$factory = new Factory($this->plugin);

			// Create a disabler object
			if (!$factory->disabler->disabled()) {
				error_log('enabled');
				//$factory->setup();
			} else {
				error_log('disabled');
			}
		}
	}



}
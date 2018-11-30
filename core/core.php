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

		// Factory object
		$this->plugin->factory = new Factory($this->plugin);

		// Heartbeat setup by context
		$this->plugin->factory->setup();

		// WP init hook
		add_action('wp_print_scripts', [$this, 'scripts'], PHP_INT_MAX);
	}



	/**
	 * Handle WP init hook
	 */
	public function scripts() {

		// Check enqueued script
		if (wp_script_is('heartbeat')) {

			// Disable heartbeat attempts by context
			$this->plugin->factory->disabler();
		}
	}



}
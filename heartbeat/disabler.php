<?php

// Subpackage namespace
namespace LittleBizzy\LimitHeartbeat\Heartbeat;

/**
 * Disabler class
 *
 * @package Heartbear
 * @subpackage Limit Heartbeat
 */
class Disabler {



	/**
	 * Disabled state
	 */
	private $disabled = false;



	/**
	 * Constructor
	 */
	public function __construct($context) {

		// Front context
		if ($context->front()) {

			// Check undefined OR disabled for the frontend
			if (!defined('LIMIT_HEARTBEAT_DISABLE_FRONTEND') ||
				LIMIT_HEARTBEAT_DISABLE_FRONTEND) {

				// Remove script
 				$this->deregister();
			}

		// Admin area (no AJAX)
		} elseif ($context->admin()) {

			// Globals
			global $pagenow;

			// Check global
			if (!empty($pagenow)) {

				// Dashboard
				if ('index.php' == $pagenow) {

					// Check defined AND disabled for the dashboard
					if (defined('LIMIT_HEARTBEAT_DISABLE_DASHBOARD') &&
						LIMIT_HEARTBEAT_DISABLE_DASHBOARD) {

						// Remove script
						$this->deregister();
					}

				// Add or edit post
				} elseif ('post.php' == $pagenow || 'post-new.php' == $pagenow) {

					// Check defined AND disabled for the editor
					if (defined('LIMIT_HEARTBEAT_DISABLE_EDITOR') &&
						LIMIT_HEARTBEAT_DISABLE_EDITOR) {

						// Remove script
						$this->deregister();
					}
				}
			}
		}
	}



	/**
	 * Retrieve disabled state
	 */
	public function disabled() {
		return $this->disabled;
	}



	/**
	 * Deregister WP script
	 */
	private function deregister() {
		wp_deregister_script('heartbeat', 'remove_heartbeat', 1);
		$this->disabled = true;
	}



}
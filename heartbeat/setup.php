<?php

// Subpackage namespace
namespace LittleBizzy\LimitHeartbeat\Heartbeat;

/**
 * Disabler class
 *
 * @package Heartbeat
 * @subpackage Limit Heartbeat
 */
class Setup {



	/**
	 * Generated context object
	 */
	private $context;



	/**
	 * Interval value for inline script
	 */
	private $interval;



	/**
	 * Default new interval values
	 */
	const EDITOR = 30;
	const FRONTEND = 300;
	const DASHBOARD = 600;



	/**
	 * Constructor
	 */
	public function __construct($context) {

		// Copy context object
		$this->context = $context;

		// Filter heartbeat settings
		add_filter('heartbeat_settings', [$this, 'heartbeat'], PHP_INT_MAX);
	}



	/**
	 * Heartbeat settings filter
	 */
	public function heartbeat($settings) {


		/* Check interval request */

		// Front-end
		if ($this->context->front()) {

			// Check frontend interval constant OR default value
			$interval = defined('LIMIT_HEARTBEAT_INTERVAL_DASHBOARD')? (int) LIMIT_HEARTBEAT_INTERVAL_DASHBOARD : self::FRONTEND;

		// Admin area
		} elseif ($this->context->admin()) {

			// Globals
			global $pagenow;

			// Check global
			if (!empty($pagenow)) {

				// Dashboard
				if ('index.php' == $pagenow) {

					// Check admin dashboard interval constant OR default value
					$interval = defined('LIMIT_HEARTBEAT_INTERVAL_DASHBOARD')? (int) LIMIT_HEARTBEAT_INTERVAL_DASHBOARD : self::DASHBOARD;

				// Add or edit post
				} elseif ('post.php' == $pagenow || 'post-new.php' == $pagenow) {

					// Check admin editor interval constant OR default value
					$interval = defined('LIMIT_HEARTBEAT_INTERVAL_EDITOR')? (int) LIMIT_HEARTBEAT_INTERVAL_EDITOR : self::EDITOR;

					// Disable classic editor issue
					$this->interval = $interval;
					add_action('admin_enqueue_scripts', [$this, 'inline'], PHP_INT_MAX);
				}
			}
		}


		/* Alter interval */

		// Apply interval
		if (!empty($interval)) {

			// Affected by no-focus state
			if ($interval <= 120) {

				// Done
				$settings['interval'] = $interval;

			// Overrides no-focus state
			} else {

				// Check limit
				if ($interval > 600)  {
					$interval = 600;
				}

				// Done
				$settings['minimalInterval'] = $interval;
			}
		}

		// Done
		return $settings;
	}



	/**
	 * Inline script for non Gutenberg context
	 */
	public function inline() {

		// Check Gutenberg
		if ($this->context->gutenberg()) {
			return;
		}

		// Prepare script
		$script = 'if (jQuery) {
			jQuery(document).ready(function($) {
				if (wp.heartbeat && $("#post-lock-dialog").length) {
					wp.heartbeat.interval('.esc_attr($this->interval).');
				}
			});
		}';

		// Add script
		wp_add_inline_script('post', $script, 'after');
	}



}
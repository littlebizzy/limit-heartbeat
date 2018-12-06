<?php

// Subpackage namespace
namespace LittleBizzy\LimitHeartbeat\Helpers;

/**
 * Context class
 *
 * @package WordPress Plugin
 * @subpackage Helpers
 */
class Context {



	// Context
	private $ajax;
	private $admin;
	private $front;

	// Front
	private $cron;
	private $xmlrpc;

	// Special
	private $cli;
	private $installing;



	/**
	 * Constructor
	 */
	public function __construct() {

		// CLI mode
		$this->cli = defined('WP_CLI') && WP_CLI;

		// WP Installing
		$this->installing = defined('WP_INSTALLING') && WP_INSTALLING;

		// AJAX request
		$this->ajax = !($this->cli || $this->installing) && is_admin() && defined('DOING_AJAX') && DOING_AJAX;

		// Admin area
		$this->admin = !($this->cli || $this->installing) && is_admin() && !$this->ajax;

		// CRON request
		$this->cron =  !($this->cli || $this->installing) && !$this->admin && !$this->ajax && defined('DOING_CRON') && DOING_CRON;

		// XML-RPC request
		$this->xmlrpc =  !($this->cli || $this->installing) && !$this->admin && !$this->ajax && defined('XMLRPC_REQUEST') && XMLRPC_REQUEST;

		// Front context
		$this->front = !($this->cli || $this->installing) && !($this->admin || $this->ajax || $this->cron || $this->xmlrpc);
	}



	/**
	 * AJAX context state
	 */
	public function ajax() {
		return $this->ajax;
	}



	/**
	 * Admin context state
	 */
	public function admin() {
		return $this->admin;
	}



	/**
	 * Front context state
	 */
	public function front() {
		return $this->front;
	}



	/**
	 * Cron request mode
	 */
	public function cron() {
		return $this->cron;
	}



	/**
	 * XML-RPC request mode
	 */
	public function xmlrpc() {
		return $this->xmlrpc;
	}



	/**
	 * WP Installing mode
	 */
	public function installing() {
		return $this->installing;
	}



	/**
	 * CLI mode
	 */
	public function cli() {
		return $this->cli;
	}



	/**
	 * Determines current editor
	 * This method must be called after WP Print Scripts hook
	 */
	public function gutenberg() {

		// Gutenberg by plugin
		if (has_filter('replace_editor', 'gutenberg_init')) {
			return true;
		}

		// Gutenberg by version (>= 5.0)
		if (function_exists('use_block_editor_for_post') && use_block_editor_for_post(null)) {
			return true;
		}

		// No gutenber
		return false;
	}



}
<?php

// Subpackage namespace
namespace LittleBizzy\LimitHeartbeat\Core;

// Aliased namespaces
use \LittleBizzy\LimitHeartbeat\Helpers;
use \LittleBizzy\LimitHeartbeat\Heartbeat;

/**
 * Object Factory class
 *
 * @package Limit Heartbeat
 * @subpackage Core
 */
class Factory extends Helpers\Factory {



	/**
	 * Disabler object instance
	 */
	protected function createDisabler() {
		return new Heartbeat\Disabler(new Helpers\Context);
	}



	/**
	 * Setup object instance
	 */
	protected function createSetup() {
		return new Heartbeat\Setup;
	}



}
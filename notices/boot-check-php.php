<?php

// Execute only in specific context
if (empty($_SERVER['REQUEST_URI']) || false === strpos($_SERVER['REQUEST_URI'], '/wp-admin/plugins.php') ||
	empty($_REQUEST['action']) || ('activate' != $_REQUEST['action'] && 'error_scrape' != $_REQUEST['action']) || empty($_REQUEST['plugin'])) {
	return;
}

// Check current plugin
$ltbPlugin = explode('/', $_REQUEST['plugin']);
$ltbParentDir = dirname(dirname(__FILE__));
if ($ltbPlugin[0] != basename($ltbParentDir)) {
	unset($ltbPlugin);
	unset($ltbParentDir);
}

// Unset unused
unset($ltbPlugin);

// Load config file
$ltbConfig = @include $ltbParentDir.'/config.php';

// Unset unused
unset($ltbParentDir);

// Check config file
if (empty($ltbConfig) || !is_array($ltbConfig) || empty($ltbConfig['boot-check-php']) ||
	empty($ltbConfig['boot-check-php']['version-required']) || empty($ltbConfig['boot-check-php']['version-error'])) {
	unset($ltbConfig);
	return;
}

// Check current PHP version
if (version_compare(PHP_VERSION, $ltbConfig['boot-check-php']['version-required'], '>=')) {
	unset($ltbConfig);
	return;
}

// Debug point
/* error_log('boot-check-hp ini '.time());
error_log($_SERVER['REQUEST_URI']);
error_log(print_r($_REQUEST, true));
error_log('boot-check-php end '.time()); */

// Prepare message
$ltbMessage = $ltbConfig['boot-check-php']['version-error'];
$ltbMessage = str_replace('%php_current_version%', PHP_VERSION, $ltbMessage);
$ltbMessage = str_replace('%php_version_required%', $ltbConfig['boot-check-php']['version-required'], $ltbMessage);

// Unset unused
unset($ltbConfig);

// Force PHP error
trigger_error($ltbMessage, E_USER_ERROR);

// Unset unused
unset($ltbMessage);
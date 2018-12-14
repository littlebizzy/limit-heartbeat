<?php
/*
Plugin Name: Limit Heartbeat
Plugin URI: https://www.littlebizzy.com/plugins/limit-heartbeat
Description: Limits the Heartbeat API in WordPress to certain areas of the site (and a longer pulse interval) to reduce AJAX queries and improve resource usage.
Version: 1.1.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 3.3
WC tested up to: 3.5
PBP Version: 1.1.0
*/

// Plugin namespace
namespace LittleBizzy\LimitHeartbeat;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'lmthrt';
const VERSION = '1.1.0';

// Boot
require_once dirname(FILE).'/helpers/boot.php';
Helpers\Boot::instance(FILE);
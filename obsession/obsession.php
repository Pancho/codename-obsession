<?php
/*
Plugin Name: Obsession
Plugin URI: http://www.yourpluginurlhere.com/
Version: 0.1
Author: Raiders
Description: One plugin, one javascript to share your posts to all your favorite social networks in a simple and sleek way.
*/

define("OBSESSION_VERSION", "0.1");
define("OBSESSION_PLUGIN_DIR", dirname(__FILE__) . "/");
define("OBSESSION_PLUGIN_URL", plugins_url("obsession/"));

include(OBSESSION_PLUGIN_DIR . "config.php");
include(OBSESSION_PLUGIN_DIR . "proxy.php");


function obsession_init () {
	$obsession = new Obsession();
}

class Obsession {
	private $wp_actions = array(
		"wp_head"
	);
	function __construct() {
		foreach ($this->wp_actions as $action) {
			add_action($action, array($this, "action_$action"));
		}
	}
	function action_wp_head () {
		include obsession_get_view ("global_head");
	}
}


obsession_init();

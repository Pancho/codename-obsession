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
include(OBSESSION_PLUGIN_DIR . "/config.php");

function obsession_init () {
	$obsession = new Obsession();
}

class Obsession {
	private $wp_actions = array(
		"in_admin_footer"
	);
	private $params = array();
	function __construct() {
		foreach ($this->wp_actions as $action) {
			add_action($action, array($this, "action_$action"));
		}
		$this->params = array(
			'wp_version' => get_bloginfo('version', 'raw'),
			'user' => md5(get_bloginfo('wpurl', 'raw')), // anonymize
			'language' => get_bloginfo('language', 'raw')
		);
	}

	function action_in_admin_footer () {
		$get_params = obsession_parse_params(array_merge($this->params, array(
			'event' => 'compose_open',
			'timestamp' => obsession_timestamp()
		)));
		$src = OBSESSION_PLUGIN_URL . 'proxy.php' . $get_params;
		$attributes = array(
			'src' => $src,
			'alt' => 'Codename: Obsession',
			'style' => 'display:none;visibility:hidden;opacity:0;',
			'width' => '0',
			'height' => '0',
			'id' => 'obsession-img'
		);
		foreach($this->params as $par_key => $par_val) {
			$attributes["data-$par_key"] = $par_val;
		}
		$img_attributes = '';
		foreach($attributes as $attr => $val) {
			$img_attributes .= "$attr=\"" . $val . "\" ";
		}
		include obsession_get_view ("admin_footer");
	}
}

obsession_init();

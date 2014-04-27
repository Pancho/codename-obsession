<?php

define("OBSESSION_INFO_ENDPOINT", "http://localhost/~sigi/coinfo.php");
define("OBSESSION_DATEFORMAT", "Y-m-d h:i:s");

function obsession_get_view ($view) {
	return OBSESSION_PLUGIN_DIR . "views/$view.php";
}

function obsession_timestamp () {
	// timestamp in milliseconds (JS timestamp)
	return strtotime(date(OBSESSION_DATEFORMAT)) * 1000;
}

function obsession_parse_params($params) {
	$get_params = array();
	foreach($params as $param => $val) {
		$get_params[] = urlencode($param) . "=" . urlencode($val);
	}
	return "?" . implode("&", $get_params);
}
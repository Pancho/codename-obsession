<?php

define("OBSESSION_INFO_ENDPOINT", "http://www.cheese.si/coinfo.php");
define("OBSESSION_DATEFORMAT", "Y-m-d h:i:s");

function obsession_get_view ($view) {
	return OBSESSION_PLUGIN_DIR . "views/$view.php";
}

function obsession_timestamp () {
	// timestamp in milliseconds (JS timestamp)
	return strtotime(date(OBSESSION_DATEFORMAT)) * 1000;
}

function obsession_parse_params($params) {
	if (isset($params['action'])) { unset($params['action']); };
	return "?" . http_build_query($params);
}
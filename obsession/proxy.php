<?php

class ObsessionProxy {
	private $parameters, $url;
	public function __construct() {
		$this->parameters = $_GET;
		$this->url = OBSESSION_INFO_ENDPOINT;
	}

	private function parse_params() {
		return obsession_parse_params($this->parameters);
	}
	
	public function log() {
		/* trigger_error("\n".$this->url . $this->parse_params()."\n"); */
		/* $response = file_get_contents($this->url . $this->parse_params()); */

		/* if (!$response) { print 'fail';} */
		/* print $response; */
		$response = wp_remote_get($this->url . $this->parse_params());
		if (!is_wp_error($response)) {
			return true;
		}
		return false;
	}
}
function obsession_ajax_callback () {
	$proxy = new ObsessionProxy();
	$proxy->log();
	header('Content-type: image/gif');
	echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
	die();	
}
add_action('wp_ajax_obsession', 'obsession_ajax_callback');


//header('Content-type: image/gif');
//echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');

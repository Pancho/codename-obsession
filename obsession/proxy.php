<?php

include(dirname(__FILE__) . "/config.php");

class ObsessionProxy {
	private $parameters, $url;
	public function __construct() {
		$this->parameters = $_GET;
		$this->url = OBSESSION_INFO_ENDPOINT;
	}

	private function parse_params() {
		return obsession_parse_params($this->params);
	}
	
	public function log() {
		$response = file_get_contents($this->url . $this->parse_params());
	}
}

$proxy = new ObsessionProxy();
$proxy->log();
header('Content-type: image/gif');
echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');

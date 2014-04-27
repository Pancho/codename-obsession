<?php

include(dirname(__FILE__) . "/config.php");

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
		print $this->url . $this->parse_params() . '<br />';
		$response = @file_get_contents($this->url . $this->parse_params());
		if ($response === false) {
//pass
		}
		else {
//fail
		}
		
	}
}

$proxy = new ObsessionProxy();
$proxy->log();

header('Content-type: image/gif');
echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');

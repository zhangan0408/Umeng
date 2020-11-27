<?php
namespace Carsdaq\Notice\IOS;

use Carsdaq\Notice\IOSNotification;

class IOSBroadcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}

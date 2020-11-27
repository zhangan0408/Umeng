<?php
namespace Carsdaq\Notice\Android;

use Carsdaq\Notice\AndroidNotification;

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}

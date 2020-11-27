<?php

namespace Carsdaq\Notice\Pusher;

class UmengPusher
{
    private $android = null;
    private $ios = null;
    public function __construct() {
        $iosAppKey = config('umeng.ios_app_key');
        $iosAppMasterSecret = config('umeng.ios_app_master_secret');
        $androidAppKey = config('umeng.android_app_key');
        $androidAppMasterSecret = config('umeng.android_app_master_secret');

        $this->android = AndroidPusher::getInstance($androidAppKey, $androidAppMasterSecret);
        $this->ios = IOSPusher::getInstance($iosAppKey, $iosAppMasterSecret);
    }

    public function android(){
        return $this->android;
    }

    public function ios(){
        return $this->ios;
    }
}

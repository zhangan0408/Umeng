<?php

namespace Carsdaq\Notice\Pusher;

class UmengPusher
{
    private static $android = null;
    private static $ios = null;
    public function __construct() {
        $iosAppKey = config('umeng.ios_app_key');
        $iosAppMasterSecret = config('umeng.ios_app_master_secret');
        $androidAppKey = config('umeng.android_app_key');
        $androidAppMasterSecret = config('umeng.android_app_master_secret');

        self::$android = AndroidPusher::getInstance($androidAppKey, $androidAppMasterSecret);
        self::$ios= IOSPusher::getInstance($iosAppKey, $iosAppMasterSecret);
    }

    public static function android(){
        return self::android();
    }

    public static function ios(){
        return self::ios();
    }
}

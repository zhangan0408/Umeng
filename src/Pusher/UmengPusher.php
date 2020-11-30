<?php

namespace Carsdaq\Notice\Pusher;

class UmengPusher
{
    protected static $android = null;
    protected static $ios = null;
    protected static $androidAppKey;
    protected static $androidAppMasterSecret;
    protected static $iosAppKey;
    protected static $iosAppMasterSecret;
    public function __construct() {
        $this->setAppParam();
    }

    protected function setAppParam() {
        if (config('umeng.production_mode')) {

            self::$iosAppKey = env("MASTER_IOS_APP_KEY");
            self::$iosAppMasterSecret = env("MASTER_IOS_APP_SECRET");
            self::$androidAppKey = env("MASTER_IOS_APP_KEY");
            self::$androidAppMasterSecret = env("MASTER_IOS_APP_SECRET");
        } else {
            self::$iosAppKey = env("DEV_IOS_APP_KE");
            self::$iosAppMasterSecret = env("DEV_IOS_APP_SECRET");
            self::$androidAppKey = env("DEV_IOS_APP_KEY");
            self::$androidAppMasterSecret = env("DEV_IOS_APP_SECRET");
        }
        self::$android = AndroidPusher::getInstance(self::$androidAppKey, self::$androidAppMasterSecret);
        self::$ios= IOSPusher::getInstance(self::$iosAppKey, self::$iosAppMasterSecret);
    }

    public static function android(){
        return self::$android;
    }

    public static function ios(){
        return self::$ios;
    }
}

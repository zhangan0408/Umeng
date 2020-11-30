<?php

namespace Carsdaq\Notice\Pusher;

class UmengPusher
{
    protected static $androidAppKey;
    protected static $androidAppMasterSecret;
    protected static $iosAppKey;
    protected static $iosAppMasterSecret;
    private static $instance;
    private function __construct() {
        $this->setAppParam();
    }


    public static function getInstance() {
        if ( is_null( self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone(){}

    private function setAppParam() {
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
    }

    public function android(){
        return new AndroidPusher(self::$androidAppKey, self::$androidAppMasterSecret);
    }

    public function ios(){
        return new IOSPusher(self::$iosAppKey, self::$iosAppMasterSecret);
    }
}

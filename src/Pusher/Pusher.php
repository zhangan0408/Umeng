<?php


namespace Carsdaq\Notice\Pusher;


class Pusher
{
    protected $appKey = null;
    protected $appMasterSecret = null;
    protected $timestamp = null;
    protected $production_mode = false;

    public static $instance;


    public function __construct($appKey,$appMasterSecret){
        $this->appKey = $appKey;
        $this->appMasterSecret = $appMasterSecret;
        $this->timestamp = strval(time());
        $this->production_mode = config('umeng.production_mode');
    }

    public static function getInstance($appKey, $masterSecret) {
        if ( is_null( self::$instance) ) {
            self::$instance = new self($appKey,$masterSecret);
        }
        return self::$instance;
    }

}

<?php


namespace Carsdaq\Notice\Pusher;


class Pusher
{
    protected $appKey = null;
    protected $appMasterSecret = null;
    protected $timestamp = null;
    protected $production_mode = false;


    public function __construct($appKey,$appMasterSecret){
        $this->appKey = $appKey;
        $this->appMasterSecret = $appMasterSecret;
        $this->timestamp = strval(time());
        $this->production_mode = config('umeng.production_mode');
    }


}

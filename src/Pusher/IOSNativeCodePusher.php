<?php


namespace Carsdaq\Notice\Pusher;


use Carsdaq\Notice\IOS\IOSNative;

class IOSNativeCodePusher extends Pusher
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 原生IOS推送
     * @param array $data
     * @return bool
     * @throws \Carsdaq\Notice\Exception\UmengException
     */
    public function sendNativeCodeMsg($data = []) {
        $nativeCode = new IOSNative($data);
        $nativeCode->setParam();
        $nativeCode->isComplete();
        return $nativeCode->send();
    }

}
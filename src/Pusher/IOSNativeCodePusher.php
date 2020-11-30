<?php


namespace Carsdaq\Notice\Pusher;


use Carsdaq\Notice\IOS\IOSNative;

class IOSNativeCodePusher extends Pusher
{
    public $ios_pem_mode;

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
        $this->ios_pem_mode = config('umeng.pem_mode');
        $nativeCode->setParam();
        $nativeCode->setProductionMode($this->ios_pem_mode);
        if ($this->ios_pem_mode) { // 正式
            $nativeCode->setPathPem(config('umeng.master_ios_pem'));
        } else { // 测试
            $nativeCode->setPathPem(config('umeng.dev_ios_pem'));
        }
        $nativeCode->isComplete();
        return $nativeCode->send();
    }

}
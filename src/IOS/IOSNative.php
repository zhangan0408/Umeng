<?php


namespace Umeng\Notice\IOS;


use Umeng\Notice\Exception\UmengException;
use Umeng\Notice\IOSNativeCode;

class IOSNative extends IOSNativeCode
{
    function __construct($data)
    {
        parent::__construct();
        $this->data = $data;

    }

    function setParam()
    {
        parent::setParam(); // TODO: Change the autogenerated stub
    }

    function isComplete()
    {
        parent::isComplete(); // TODO: Change the autogenerated stub
        if (!is_file($this->pemPath)) {
            \Log::error("证书不存在");
            throw new UmengException("证书文件不存在，请检查文件权限或路径是否正确");
        }
    }


}
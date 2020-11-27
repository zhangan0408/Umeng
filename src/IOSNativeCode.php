<?php


namespace Carsdaq\Notice;


use Carsdaq\Notice\Exception\UmengException;

abstract class IOSNativeCode
{
    // 这里是我们上面得到的deviceToken(IOS提供)
    protected $deviceToken;
    // 证书的密码
    protected $passphrase;
    // 信息
    protected $message;
    // 证书地址
    protected $pemPath;

    //正式 沙盒
    protected $production_mode = false;

    protected $data = [
        'deviceToken' => null,
        'passphrase' => null,
        'message' => null,
        'pemPath' => null,
        'production_mode' => null
    ];

    protected $keys = ['deviceToken','passphrase','message','pemPath','production_mode'];

    public function __construct()
    {
    }



    function setParam() {
        foreach ($this->data as $key => $value) {
            if (is_null($value)) {
                \Log::error($key . " is NULL!");
                throw new UmengException($key . " is NULL!");
            }
            if (is_array($key,$this->keys)) {
                $this->$key = $value;
            }
        }
    }

    function isComplete() {

        $this->checkArrayValues($this->data);
        return TRUE;
    }

    private function checkArrayValues($arr) {
        foreach ($arr as $key => $value) {
            if (is_null($value)){
                \Log::error("Caught Umeng exception: ".$key . " is NULL!");
                throw new UmengException($key . " is NULL!");
            }
            else if (is_array($value)) {
                $this->checkArrayValues($value);
            }
        }
    }

    /**
     * 发送消息
     * @return bool
     * @throws UmengException
     */
    function send() {
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $this->pemPath);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);
        if ($this->production_mode) {
            $fp = stream_socket_client("ssl://gateway.push.apple.com:2195",
                $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        } else {
            $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        }

        if (!$fp) {
            \Log::error("链接证书失败：证书路径".$this->pemPath.",密码短语".$this->passphrase);
            throw new UmengException("证书链接失败");
        }

        // Create the payload body
        $body['aps'] = array(
            'alert' => $this->message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        if (is_array($this->deviceToken) && !is_null($this->deviceToken)) {
            if (count($this->deviceToken) <= 0) {
                \Log::error("传递deviceToke为空");
                 throw new UmengException("传递deviceToke为空");
            }
            foreach ($this->deviceToken as $value) {
                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ','',$this->deviceToken)) . pack('n', strlen($payload)) . $payload;

                // Send it to the server
                $result = fwrite($fp, $msg, strlen($msg));

                if (!$result) {
                    \Log::error("消息发送失败：".$result."错误机型：".$value);
                    // throw new UmengException("证书链接失败：".$result);
                }
                continue;
            }
        } else {
            $msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ','',$this->deviceToken)) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            if (!$result) {
                \Log::error("消息发送失败：".$result."错误机型：".$this->deviceToken);
                 throw new UmengException("证书链接失败：".$result);
            }
        }

        // Close the connection to the server
        fclose($fp);
        return true;
    }
















}
# 基于umeng官方php sdk v1.4,支持Laravel5以及Lumen5

## 安装
```php
    composer reuqire Carsdaq/notice --dev    
```
  
## Laravel 5.* 配置
打开config目录下的app.php文件,找到provider,添加如下代码:

```php
    'provider' => [
       Carsdaq\Notice\UmengServiceProvider::class, 
    ],
```
配置alias:

```php
    'aliases' => [
        'Umeng' => Carsdaq\Notice\Facades\Umeng::class,
    ],
```

生成配置文件:

```php
    php artisan vendor:publish   
```

在配置文件umeng.php中填入appkey以及master_secret既可完成配置

## 在Lumen 5.*中配置

打开bootstrap目录下的app.php文件,注册provider:

```php
    $app->register(Carsdaq\Notice\UmengServiceProvider::class);
```

配置alias:

```php
    class_alias('Carsdaq\Notice\Facades\Umeng','Umeng');
```

生成配置文件:

```php
    php artisan vendor:publish 
```

在配置文件umeng.php中填入appkey以及master_secret既可完成配置

## 用法

###注意：
友盟的推送 参数需要在.env文件配置 正式测试环境的 key 和 secret ，友盟 UMENG_MODE true为正式环境  false为测试环境；
IOS原生 pem_mode 为true正式证书  false测试证书 
 

Android用法:
```php

    use Umeng;
    
    $device_token = 'xxxx'; // 设备号
    $predefined = ['ticker'=> '通知栏提示','title'=>'通知标题','text'=>'测试测试测试','after_open'=>'go_app'];;
    $extraField = array(); //other extra filed
    UmengPusher::getInstance()->android()->sendUnicast($device_token,$predefined,$extraField); //单播

```

IOS用法:

```php
    
    use Umeng;
    
    $device_token = 'xxxx'; // 设备号
    $predefined = ['ticker'=> '通知栏提示','title'=>'通知标题','text'=>'测试测试测试','after_open'=>'go_app'];;
    $extraField = array(); //other extra filed
    UmengPusher::getInstance()->ios()->sendUnicast($device_token,$predefined,$extraField); //单播
    
```
IOS原生推送用法:

```php
    
     $iosPush = new IOSNativeCodePusher();
            $data = [
                'deviceToken'=>'9644e180a71d571731b1ddd99983fd8a4c8b7f981513e35e2f3e5c830ddc3f06', // 设备号
                'passphrase'=> 'zhangtp', // pem密码短语
                'message'=>'测试测试测试' // 消息
            ];
    
            $pemPath = [
                'dev' => '', // 测试pem
                'master'=> '' // 正式pem
            ];
    
            $data =$iosPush->sendNativeCodeMsg($data,$pemPath);
    
```
## Api

说明: Android API跟 IOS一样

```php
    
    sendBroadcast($predefined = [], $extraField = []); //广播
    sendUnicast($device_tokens = '', $predefined= [], $extraField = []); //单播
    sendListcast($device_tokens = '', $predefined= [], $extraField = []); //列播
    sendFilecast($fileContents = '', $predefined= [],$extraField = []); //文件播
    sendGroupcast($filter = [], $predefined= [], $extraField = []); //组播
    sendCustomizedcast($alias = '', $alias_type = '', $predefined= [], $extraField = []); //自定义播,通过alias
    sendCustomizedcastFileId($file_contents = '', $predefined= [], $extraField = []); //自定义播,通过file_id
    sendNativeCodeMsg($data=[]); // 适配ios原生消息推送
    
```

## Exception

程序不处理异常,可根据业务情况自行处理, 若抛出异常,可通过 `e->getHttpCode()` 获取http状态码, 通过 `e->getErrCode()`获取umeng返回的错误码.
使用过程中若出错,可自行查看Laravel或Lumen的Log日志
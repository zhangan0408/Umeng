<?php

return [
    'ios_app_key'               => '',
    'ios_app_master_secret'     => '',
    'android_app_key'           => '',
    'android_app_master_secret' => '',
    'production_mode'           => env('UMENG_MODE', false), // 友盟推送方式（正式、测试）
    'pem_mode'                  => env('IOS_PEM_MODE', false), // IOS原生 推送模式（正式、测试)
    'dev_ios_pem'               => env('DEV_IOS_PEM',false), // 测试环境证书
    'master_ios_pem'            => env('MASTER_IOS_PEM',false), // 正式环境证书
];

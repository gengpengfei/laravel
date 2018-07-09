<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => 'shikefood@sina.com',

        // 支付宝异步通知地址
        'notify_url' => 'http://139.224.220.33:8867',

        // 支付成功后同步通知地址
        'return_url' => 'http://139.224.220.33:8867',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => '123',

        // 自己的私钥，签名时使用
        'private_key' => 'vs1lheilel0d561zt72ukgtb2xep0e',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
             'level' => 'debug'
        ],

        // optional，设置此参数，将进入沙箱模式
         'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号 APPID
        'app_id' => 'wxa3dd959056ec940b',

        // 小程序 APPID
        'miniapp_id' => 'wxa3dd959056ec940b',

        // APP 引用的 appid
        'appid' => 'wxa3dd959056ec940b',

        // 微信支付分配的微信商户号
        'mch_id' => '1320231701',

        // 微信支付异步通知地址
        'notify_url' => 'http://139.224.220.33:8867',

        // 微信支付签名秘钥
        'key' => 'lz1izTayx84TDAadGSuf9LfwjTBCYceV',

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
//             'level' => 'debug'
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
//         'mode' => 'dev',
    ],
];

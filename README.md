# short-messenger

PHP 短信组件包，支持阿里云短信和 SendCloud 短信。

![PHP](https://img.shields.io/badge/PHP-5.6%2C7.0%2C7.1-blue.svg)
![license](https://img.shields.io/github/license/mashape/apistatus.svg)
[![Build Status](https://travis-ci.org/HyanCat/short-messenger.svg?branch=master)](https://travis-ci.org/HyanCat/short-messenger)

## Requirements

`short-messenger` 依赖于以下工具包或环境

- PHP: >= 5.6
- composer

## Installation

使用 composer 安装依赖包

    composer require hyancat/short-messenger

## Usage

### Generally

1. 配置

    ```php
    $config = [
        'default' => 'aliyun',

        'providers' => [
            'aliyun'    => [
                'region'     => 'cn-hangzhou',
                'access_id'  => 'xxx',
                'access_key' => 'yyy',
            ],
            'sendcloud' => [
                'sms_user' => 'xxx',
                'sms_key'  => 'yyy',
            ],
        ],
    ];
    ```
2. 代码示例

    ```php
    // 配置驱动
    $manager = new SmsManager();
    $manager->config($config);
    $manager->extend('aliyun', function () use ($config) {
        return new AliyunProvider($config['providers']['aliyun']);
    });
    $manager->extend('sendcloud', function () use ($config) {
        return new SendCloudProvider($config['providers']['sendcloud']);
    });
    // 创建 Service
    $smsService = new SmsService($manager);
    $smsService->send('186xxx', function (ShortMessage $message) {
        $message->template('template_123')
                ->signature('SIGNATURE_xx')
                ->data(['code' => 1234]);
    });
    ```

### Laravel or Lumen

1. 添加 ServiceProvider

    ```php
    HyanCat\ShortMessenger\SmsServiceProvider::class
    ```

2. 配置 sms.php

    ```php
    [
        'default' => 'aliyun',

        'providers' => [

            'aliyun' => [
                'region'     => 'cn-hangzhou',
                'access_id'  => env('ALIYUN_SMS_ACCESS_ID', ''),
                'access_key' => env('ALIYUN_SMS_ACCESS_KEY', ''),
            ],

            'sendcloud' => [
                'sms_user' => env('SENDCLOUD_SMS_USER', ''),
                'sms_key'  => env('SENDCLOUD_SMS_KEY', ''),
            ],
        ]
    ]
    ```

    在 Laravel 框架下可以使用 artisan 命令创建：

        php artisan vendor:publish --provider=HyanCat\ShortMessenger\SmsServiceProvider

3. 代码示例

    ```php
    use HyanCat\ShortMessenger\SmsServiceFacade as SMS;

    SMS::send('18688888888', function (ShortMessage $message) {
        $message->template('template_123')
                ->signature('SIGNATURE_xx')
                ->data(['code' => 1234]);
    });
    ```

## License

```text
The MIT License (MIT)

Copyright (c) 2017 HyanCat <hyancat@live.cn>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```



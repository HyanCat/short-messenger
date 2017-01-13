<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace Tests;

use HyanCat\ShortMessenger\Providers\AliyunProvider;
use HyanCat\ShortMessenger\ShortMessage;
use HyanCat\ShortMessenger\SmsManager;
use PHPUnit_Framework_TestCase;
use HyanCat\ShortMessenger\SmsService;

/**
 * Class AliyunSmsTest
 */
class AliyunSmsTest extends PHPUnit_Framework_TestCase
{
    protected $smsService;

    public function __construct()
    {
        parent::__construct();

        // Config.
        $config = [
            'default' => 'aliyun',

            'providers' => [
                'aliyun' => [
                    'region'     => 'cn-hangzhou',
                    'access_id'  => 'xxx',
                    'access_key' => 'yyy',
                ],
            ],
        ];

        // Create manager and service.
        $manager = new SmsManager();
        $manager->config($config);
        $manager->extend('aliyun', function () use ($config) {
            return new AliyunProvider($config['providers']['aliyun']);
        });
        $this->smsService = new SmsService($manager);
    }

    public function testSendMessage()
    {
        // Send short message.
        $this->smsService->send('[186xxx]', function (ShortMessage $message) {
            $message->template('SMS_13190010')->signature('[xxAliyun]')->data(['customer' => '小强']);
        });
    }
}

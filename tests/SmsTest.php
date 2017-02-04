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
use HyanCat\ShortMessenger\Providers\SendCloudProvider;
use HyanCat\ShortMessenger\SmsManager;
use HyanCat\ShortMessenger\SmsService;
use PHPUnit_Framework_TestCase;

abstract class SmsTest extends PHPUnit_Framework_TestCase
{
    protected $smsService;

    public function __construct()
    {
        parent::__construct();

        // Config.
        $configFile = __DIR__ . '/../config/sms.test.php';
        if (file_exists($configFile)) {
            $config = require_once $configFile;
        } else {
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
        }

        // Create manager and service.
        $manager = new SmsManager();
        $manager->config($config);
        $manager->extend('aliyun', function () use ($config) {
            return new AliyunProvider($config['providers']['aliyun']);
        });
        $manager->extend('sendcloud', function () use ($config) {
            return new SendCloudProvider($config['providers']['sendcloud']);
        });
        $this->smsService = new SmsService($manager);
    }
}

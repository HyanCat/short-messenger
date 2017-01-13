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

        $config = require_once __DIR__ . '/../config/sms.php';

        $manager = new SmsManager();
        $manager->config($config);
        $manager->extend('aliyun', function () use ($config) {
            return new AliyunProvider($config['providers']['aliyun']);
        });
        $this->smsService = new SmsService($manager);
    }

    public function testSendMessage()
    {
        $this->smsService->send('13282819200', function (ShortMessage $message) {
            $message->template('SMS_13190010')->signature('Aliyun')->data(['customer' => '小强']);
        });
    }
}

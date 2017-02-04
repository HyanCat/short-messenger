<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace Tests;

use HyanCat\ShortMessenger\ShortMessage;

/**
 * Test aliyun sms.
 * Class AliyunSmsTest
 * @namespace Tests
 */
class AliyunSmsTest extends SmsTest
{
    public function testSendMessage()
    {
        // Send short message.
        /*
        $this->smsService->send('[186xxx]', function (ShortMessage $message) {
            $message->template('SMS_13190010')->signature('[xxAliyun]')->data(['customer' => '小强']);
        });
        */
    }
}

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
 * Test sendcloud sms.
 * Class SendCloudSmsTest
 * @namespace Tests
 */
class SendCloudSmsTest extends SmsTest
{
    public function testSendMessage()
    {
        // Send short message.
        $this->smsService->send('[186xxx]', function (ShortMessage $message) {
            $message->template('1000')->signature('[xxSendCloud]')->data(['customer' => '小强']);
        });
    }
}

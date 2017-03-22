<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger\Providers;

require_once __DIR__ . '/../../libs/sendcloud-php-sdk/SendCloudSMS.php';
require_once __DIR__ . '/../../libs/sendcloud-php-sdk/util/SMS.php';

use HyanCat\ShortMessenger\ShortMessage;
use SendCloudSMS;

class SendCloudProvider implements SmsProvider
{
    /**
     * @var SendCloudSMS
     */
    protected $client;

    /**
     * @var mixed
     */
    protected $response;

    public function __construct($config)
    {
        $this->client = new SendCloudSMS($config['sms_user'], $config['sms_key']);
    }

    /**
     * @inheritdoc
     */
    public function send($receiver, ShortMessage $message)
    {
        return $this->sendInBulk([$receiver], $message);
    }

    /**
     * @inheritdoc
     */
    public function sendInBulk($receivers, ShortMessage $message)
    {
        $msg = new \SmsMsg();
        $msg->setMsgType(\MsgType::SMS);
        $msg->setTemplateId($message->getTemplate());
        $msg->addPhoneList($receivers);
        foreach ($message->getData() as $k => $v) {
            $msg->addVars($k, $v);
        }
        $this->response = $this->client->send($msg);
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

}

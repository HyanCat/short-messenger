<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger\Providers;

require_once __DIR__ . '/../../libs/aliyun-php-sdk-sms/aliyun-php-sdk-core/Config.php';

use HyanCat\ShortMessenger\ShortMessage;
use HyanCat\ShortMessenger\SmsException;
use Sms\Request\V20160927 as SMS;

class AliyunProvider implements SmsProvider
{
    protected $request;

    /**
     * SMS ACS Client Instance.
     * @var \DefaultAcsClient
     */
    protected $client;

    public function __construct($config)
    {
        $clientProfile = \DefaultProfile::getProfile($config['region'], $config['access_id'], $config['access_key']);
        $this->client  = new \DefaultAcsClient($clientProfile);
        $this->request = new SMS\SingleSendSmsRequest();
    }

    public function send($receiver, ShortMessage $message)
    {
        $this->request->setSignName($message->getSignature());
        $this->request->setTemplateCode($message->getTemplate());
        $this->request->setRecNum($receiver);
        $this->request->setParamString(json_encode($message->getData()));
        try {
            $response = $this->client->getAcsResponse($this->request);
            print_r($response);
        } catch (\ClientException $e) {
            throw new SmsException($e->getErrorMessage(), -1);
        }
    }

    public function sendBatch($receivers, ShortMessage $message)
    {
        foreach ($receivers as $receiver) {
            $this->send($receiver, $message);
        }
    }
}

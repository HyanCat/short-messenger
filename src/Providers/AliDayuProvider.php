<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace HyanCat\ShortMessenger\Providers;

require_once __DIR__ . '/../../libs/aliyun-php-sdk-sms/Dysmsapi/Request/V20170525/SendSmsRequest.php';
require_once __DIR__ . '/../../libs/aliyun-php-sdk-sms/Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php';
use HyanCat\ShortMessenger\ShortMessage;
use HyanCat\ShortMessenger\SmsException;
use Dysmsapi\Request\V20170525 as SMS;

class AliDayuProvider implements SmsProvider
{
    /**
     * SMS ACS Client Instance.
     * @var \DefaultAcsClient
     */
    protected $client;

    /**
     * @var SMS\SendSmsRequest
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $response;

    public function __construct($config)
    {
        $clientProfile = \DefaultProfile::getProfile($config['region'], $config['access_id'], $config['access_key']);
        \DefaultProfile::addEndpoint('cn-hangzhou', 'cn-hangzhou', 'Dysmsapi', 'dysmsapi.aliyuncs.com');
        $this->client  = new \DefaultAcsClient($clientProfile);
        $this->request = new SMS\SendSmsRequest();
    }

    /**
     * @inheritdoc
     */
    public function send($receiver, ShortMessage $message)
    {
        $this->request->setSignName($message->getSignature());
        $this->request->setTemplateCode($message->getTemplate());
        $this->request->setPhoneNumbers($receiver);
        $this->request->setTemplateParam(json_encode($message->getData()));
        try {
            $this->response = $this->client->getAcsResponse($this->request);
        } catch (\ClientException $e) {
            throw new SmsException($e->getErrorMessage(), -1);
        }
    }

    /**
     * @inheritdoc
     */
    public function sendInBulk($receivers, ShortMessage $message)
    {
        foreach ($receivers as $receiver) {
            $this->send($receiver, $message);
        }
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }
}

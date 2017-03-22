<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger\Providers;

use HyanCat\ShortMessenger\ShortMessage;

/**
 * Interface SmsProvider
 * @namespace HyanCat\ShortMessenger\Providers
 */
interface SmsProvider
{
    /**
     * Send a short message to a receiver.
     * @param              $receiver
     * @param ShortMessage $message
     * @return mixed
     */
    public function send($receiver, ShortMessage $message);

    /**
     * Send short messages to some receivers in bulk.
     * @param              $receivers
     * @param ShortMessage $message
     * @return mixed
     */
    public function sendInBulk($receivers, ShortMessage $message);

    /**
     * Get the response for sms request.
     * @return mixed
     */
    public function getResponse();
}

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

interface SmsProvider
{
    public function send($receiver, ShortMessage $message);

    public function sendBatch($receivers, ShortMessage $message);
}

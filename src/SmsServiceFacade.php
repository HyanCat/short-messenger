<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger;

use Illuminate\Support\Facades\Facade;

class SmsServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hyancat.sms';
    }
}

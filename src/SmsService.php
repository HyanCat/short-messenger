<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger;

class SmsService
{
    protected $manager;

    public function __construct(SmsManager $manager)
    {
        $this->manager = $manager;
    }

    public function driver($driver = null)
    {
        $this->manager->driver($driver);

        return $this;
    }

    public function send($receivers, callable $callback)
    {
        $message = new ShortMessage();
        if ($callback instanceof \Closure) {
            $callback($message);
        }
        if (is_string($receivers)) {
            $this->manager->send($receivers, $message);
        } else {
            $this->manager->sendInBulk($receivers, $message);
        }
    }
}

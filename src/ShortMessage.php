<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger;

/**
 * Short message class.
 * Class ShortMessage
 * @namespace HyanCat\ShortMessenger
 */
class ShortMessage
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $signature;

    public function template($value)
    {
        $this->template = $value;

        return $this;
    }

    public function data($value)
    {
        $this->data = $value;
        return $this;
    }

    public function signature($value)
    {
        $this->signature = $value;
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getSignature()
    {
        return $this->signature;
    }
}

<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger;

class SmsManager
{
    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @var array
     */
    protected $config  = [];

    public function config($config)
    {
        $this->config = $config;
    }

    public function driver($driver = null)
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if (! isset($this->drivers[$driver])) {
            $this->resolve($driver);
        }
        return $this->drivers[$driver];
    }

    public function extend($driver, callable $callback)
    {
        $provider = $callback();

        $this->drivers[$driver] = $provider;
    }

    public function resolve($driver)
    {
        //
    }

    public function getDefaultDriver()
    {
        return $this->config['default'];
    }

    /**
     * Dynamically call method through the default driver instance.
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }
}

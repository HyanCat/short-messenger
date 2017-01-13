<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */
namespace HyanCat\ShortMessenger;

use HyanCat\ShortMessenger\Providers\AliyunProvider;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $config;

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/sms.php' => config_path('sms.php')]);
    }

    public function register()
    {
        $this->config = $this->app['Illuminate\Contracts\Config\Repository'];

        $this->registerManager();
        $this->registerService();
        $this->extendAliyunProvider();
    }

    public function provides()
    {
        return ['hyancat.sms'];
    }

    private function registerManager()
    {
        $this->app->singleton('hyancat.sms.manager', function ($app) {
            $manager = new SmsManager();
            $manager->config($this->config['sms']);
            return $manager;
        });
    }

    private function registerService()
    {
        $this->app->bind('hyancat.sms', function ($app) {
            return new SmsService($app['hyancat.sms.manager']);
        });
    }

    private function extendAliyunProvider()
    {
        $this->app['hyancat.sms.manager']->extend('aliyun', function () {
            return new AliyunProvider($this->config['sms.providers.aliyun']);
        });
    }
}

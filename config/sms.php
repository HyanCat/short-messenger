<?php
/**
 * This file is part of short-messenger.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

return [

    'default' => 'aliyun',

    'providers' => [
        'aliyun' => [
            'region'     => 'cn-hangzhou',
            'access_id'  => env('SMS_ACCESS_ID', ''),
            'access_key' => env('SMS_ACCESS_KEY', ''),
        ],
    ],
];

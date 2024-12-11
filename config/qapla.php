<?php

return [
    /*
     * The private API key to use for the Qapla' API
     */
    'private_api_key' => env('QAPLA_PRIVATE_API_KEY', 'your-private-api-key'),

    /*
     * The public API key to use for the Qapla' API
     */
    'public_api_key' => env('QAPLA_PUBLIC_API_KEY', 'your-public-api-key'),

    /*
     * The version of API to use for the Qapla' API. Available options are:
     *  12 => v1.2
     *  13 => v1.3
     *
     * Note:
     * v1.2 is actually deprecated,
     * all endpoints are still available but no new features will be added.
     *
     * v1.1 is deprecated and not supported on this release,
     * if you need it please download the previous version of this package.
     */
    'api_version' => env('QAPLA_API_VERSION', 12),

    /*
     * Get shipments from a specific datetime.
     * Default is from 1970 its is the first date of the Unix Epoch
     */
    'tracks' => [
        'default_fromDate'  => '1970-01-01 00:00:00',
    ],

    /*
     * Get orders from a specific datetime.
     * Default is from 1970 its is the first date of the Unix Epoch
     */
    'orders' => [
        'default_fromDate'  => '1970-01-01 00:00:00',
    ],

    /*
     * Default country for couriers
     */
    'couriers' => [
        'default_country' => 'it,global',
    ],

];

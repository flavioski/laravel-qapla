<?php

return [

    /*
     * The URL to call for API functionalities
     * @deprecated and will be updated in the next release
     */
    'url' => 'https://api.qapla.it/1.1/',

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

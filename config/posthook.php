<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  Arie
 */

return array(
    'allowed_ips' => array(
        // Github
        '50.57.128.197/32',
        '50.57.231.61/32',
        '108.171.174.178/32',
        '192.30.252.0/22',
        '204.232.175.64/27',
        '207.97.227.253/32',

        // Bitbucket
        '63.246.22.222'
    ),
    
    'binary' => '/path/to/real/post-hook',
    'log' => TRUE,
);
<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  Arie
 */

return array(
    // post hook
    'autoupdate' => array(
        'uri_callback'  => 'posthook',
        'defaults'      => array(
            'controller'=> 'hook',
            'action'    => 'post',
        ),
    ),
);


<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  Arie
 */

abstract class Malam_Controller_Hook extends Controller
{
    public function action_post()
    {
        Post_Hook::factory()->run();
    }
}
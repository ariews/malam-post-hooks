<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  Arie
 */

class Malam_Post_Hook
{
    /**
     * Post Hook Configuration
     *
     * @var Config
     */
    private $config;

    public static function factory()
    {
        return new Post_Hook();
    }

    public function __construct()
    {
        if (Request::current()->method() != Request::POST)
        {
            throw new HTTP_Exception_403();
        }

        $this->config = Kohana::$config->load('posthook');
    }

    /**
     * Run the hook
     */
    public static function run()
    {
        if ($this->is_allowed())
        {
            $this->log('Post Hook Start');

            exec($this->config->binary);

            $this->log('Post Hook End');
        }
    }

    /**
     * Check for allowed IPs
     *
     * @return boolean
     */
    private function is_allowed()
    {
        $allowed_ips = (array) $this->config->allowed_ips;

        foreach ($allowed_ips as $allowed_ip)
        {
            if ((preg_match('!/!i', $allowed_ip) && $this->match_with($allowed_ip))
                    OR
                (Request::$client_ip == $allowed_ip))
            {
                return TRUE;
            }
        }

        $this->log('Ip Address (:ip_address) not allowed', array(
            ':ip_address'   => Request::$client_ip
        ));

        return FALSE;
    }

    /**
     * Compare IP Address with CIDR Range
     *
     * http://www.webmastertalkforums.com/html/69399-php-function-compare-ip-address-cidr-range.html
     */
    private function match_with($CIDR)
    {
        list($net, $mask) = explode('/', $CIDR);
        return (ip2long(Request::$client_ip) & ~((1 << (32 - $mask)) - 1)) == ip2long($net);
    }

    /**
     * If enable, Log the message
     * 
     * @param string $message
     * @param mix $values
     */
    private function log($message, $values = NULL)
    {
        if (TRUE === $this->config->log)
        {
            Kohana::$log->add(Log::DEBUG, $message, $values);
        }
    }
}
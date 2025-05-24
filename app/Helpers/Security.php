<?php
namespace App\Helpers;

use HTMLPurifier;
use HTMLPurifier_Config;

class Security
{
    /**
     * Sanitize HTML input using HTMLPurifier.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeHTML(string $input): string
    {
        static $purifier = null;
        if ($purifier === null) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
        }
        return $purifier->purify($input);
    }
}

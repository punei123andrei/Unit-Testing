<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Ajax;

class MetaSecurity
{
    /**
     * Verify if the API is sending a response.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return bool
     */
    public static function isApiResponding(string $url, array $data = [], array $headers = []): bool
    {
        try {
            $response = ApiRequest::makeGetRequest($url, $data, $headers);
            if (!empty($response)) {
                return true;
            }
        } catch (\Exception $error) {
            $errorMessage = 'Error: The API is not responding.';

            if ($error->getMessage()) {
                $errorMessage .= ' Reason: ' . $error->getMessage();
            }

            return $errorMessage;
        }
    }

    /**
    * Verify if the nonce is present in the POST request.
    *
    * @return bool
    */
    public static function verifyNonce(): bool
    {
        return isset($_POST['_wpnonce']);
    }

    /**
     * Write a log if WP_DEBUG is true.
     *
     * @param mixed $log
     */
    public static function writeLog($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

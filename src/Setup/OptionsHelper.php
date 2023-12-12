<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup;

use Inpsyde\Ajax\RequestHelper;

class OptionsHelper
{
    /**
    * Initialize the object with option key and value
    *
    * @param string $inputKey   The key of the option
    * @param mixed  $inputValue The value of the option
    */
    public function init(): OptionsHelper
    {
        add_action('admin_init', [$this, 'insertOption']);
        return $this;
    }

    /**
     * Set the value of a specific option
     * @param string $key The key of the option
     * @param mixed $value The value to set
     * @return bool True on success, false on failure
     */
    public function insertOption(string $key): bool
    {

        $nonceField = isset($_POST['nonce'])
        ? sanitize_text_field(wp_unslash($_POST['nonce']))
        : false;
        if ($nonceField) {
            return false;
        }

        if (!isset($_POST[$key])) {
            return false;
        }

        $value = sanitize_text_field(wp_unslash($_POST[$key]));
        if (empty($value)) {
            return false;
        }

        return update_option($key, $value);
    }
}

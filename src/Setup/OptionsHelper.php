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


class OptionsHelper {

    /**
    * Initialize the object with option key and value
    *
    * @param string $inputKey   The key of the option
    * @param mixed  $inputValue The value of the option
    */
    public function init()
    {
        add_action('admin_init', [$this, 'setOption']);
        return $this;
    }
    
    /**
     * Set the value of a specific option
     * @param string $key The key of the option
     * @param mixed $value The value to set
     * @return bool True on success, false on failure
     */
    public function setOption(string $key): bool 
    {
        $value = isset($_POST[$key]) ? $this->sanitizeOption($_POST[$key]) : '';
        return !empty($value) ? update_option($key, $value) : false;
    }
    
    /**
     * Verify and sanitize the options before saving
     * You can customize this method based on your specific needs
     * @param array $input The input options
     * @return array The sanitized options
     */
    public function sanitizeOption(string $input): string
    {
        $sanitized_input = sanitize_text_field($input);
        return $sanitized_input;
    }
    
    /**
     * Register settings with WordPress
     */
    public function register_settings(): void 
    {
        register_setting($this->option_name, $this->option_name, [$this, 'sanitize_options']);
    }
    
}
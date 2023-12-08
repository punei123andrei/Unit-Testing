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
 * The option name in the WordPress database
 * @var string
 */
private $option_name;

/**
 * YourPlugin_Options_Helper constructor.
 * @param string $option_name The option name for your plugin
 */
public function __construct(string $option_name) {
    $this->option_name = $option_name;
}






/**
 * Get the value of a specific option
 * @param string $key The key of the option
 * @param mixed $default The default value if the option is not set
 * @return mixed The option value
 */
public function get_option($key, $default = false) {
    $options = get_option($this->option_name, []);
    return isset($options[$key]) ? $options[$key] : $default;
}

/**
 * Set the value of a specific option
 * @param string $key The key of the option
 * @param mixed $value The value to set
 * @return bool True on success, false on failure
 */
public function set_option(string $key, $value = ''): bool {
    $options = get_option($this->option_name, []);
    $options[$key] = $value;
    return update_option($this->option_name, $options);
}

/**
 * Verify and sanitize the options before saving
 * You can customize this method based on your specific needs
 * @param array $input The input options
 * @return array The sanitized options
 */
public function sanitize_options(array $input): array {
    // Add your custom validation and sanitization logic here
    // Example: $sanitized_input = sanitize_text_field($input);
    return $input;
}

/**
 * Register settings with WordPress
 */
public function register_settings(): void {
    register_setting($this->option_name, $this->option_name, [$this, 'sanitize_options']);
}

}
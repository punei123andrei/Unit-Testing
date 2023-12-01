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

class Deactivate
{
    public static function deactivate()
    {
        // Trigger a custom action hook before removing the test page
        do_action('inpsyde_before_deactivate');

        self::removeTestPage();

        // Trigger a custom action hook after removing the test page
        do_action('inpsyde_after_remove_test_page');
    }

    private static function removeTestPage()
    {
        // Trigger a custom action hook before checking and removing the test page
        do_action('inpsyde_before_remove_test_page');

        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

        if ($page) {
            // Trigger a custom action hook before deleting the test page
            do_action('inpsyde_before_delete_test_page', $page->ID);

            wp_delete_post($page->ID, true);

            // Trigger a custom action hook after deleting the test page
            do_action('inpsyde_after_delete_test_page');
        }

        // Trigger a custom action hook after checking and removing the test page
        do_action('inpsyde_after_remove_test_page');
    }
}

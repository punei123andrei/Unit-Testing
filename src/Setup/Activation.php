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

class Activation
{
    /**
     * Run activation Setup
     */
    public static function activate()
    {
        if (!defined('ABSPATH') || wp_doing_cron()) {
            return;
        }

        // Trigger a custom action hook before flush_rewrite_rules
        do_action('inpsyde_before_activate');

        flush_rewrite_rules();

        // Trigger a custom action hook after flush_rewrite_rules
        do_action('inpsyde_after_flush_rewrite_rules');

        // Use a filter to allow customization of page content
        $pageContent = apply_filters('inpsyde_page_content', '
        <div id="inpsyde-content">
            <table id="inspyde-table"></table>
            <div class="inpsyde-single-user"></div>
        </div>
        ');

        self::createTestPage($pageContent);
    }

    /**
     * Create the test page
     *
     * @param string $pageContent
     */
    private static function createTestPage($pageContent)
    {
        // Trigger a custom action hook before creating the test page
        do_action('inpsyde_before_create_test_page');

        $authorId = get_current_user_id();

        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

        if (!$page) {
            $newPage = [
                'post_title'   => 'Inpsyde Users Test',
                'post_content' => $pageContent,
                'post_status'  => 'publish',
                'post_author'  => $authorId,
                'post_type'    => 'page',
            ];

            wp_insert_post($newPage);
        }

        // Trigger a custom action hook after creating the test page
        do_action('inpsyde_after_create_test_page');
    }
}
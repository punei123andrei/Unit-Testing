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

        flush_rewrite_rules();

        self::createTestPage();

    }

private static function createTestPage() {
    $author_id = get_current_user_id();

    $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

    if (!$page) {
        $new_page = array(
            'post_title'    => 'Inpsyde Users Test',
            'post_content'  => '<table id="inspyde-table"></table>',
            'post_status'   => 'publish',
            'post_author'   => $author_id,
            'post_type'     => 'page',
        );

        wp_insert_post($new_page);
    }
    }
}

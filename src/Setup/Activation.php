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

    private static function createTestPage()
    {

        $authorId = get_current_user_id();

        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

        if (!$page) {
            $pageContent = '
        <div id="inpsyde-content">
            <table id="inspyde-table"></table>
            <div class="inpsyde-single-user"></div>
        </div>
        ';
            $newPage = [
            'post_title' => 'Inpsyde Users Test',
            'post_content' => $pageContent,
            'post_status' => 'publish',
            'post_author' => $authorId,
            'post_type' => 'page',
            ];

            wp_insert_post($newPage);
        }
    }
}

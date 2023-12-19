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

/**
 * Runs specific action on activation
 *
 * @package Inpsyde\RequestDefinitions
 * @since 1.0.1
 */
class Activation
{
    /**
     * Run activation Setup
     */
    public static function activate()
    {
        if (wp_doing_cron()) {
            return;
        }

        do_action('inpsyde_before_activate');

        flush_rewrite_rules();

        do_action('inpsyde_after_flush_rewrite_rules');

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
     * @param mixed $pageContent
     */
    public static function createTestPage(mixed $pageContent): int
    {

        do_action('inpsyde_before_create_test_page');

        $authorId = get_current_user_id();

        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');
        
        if (!$page) {
            $newPage = [
                'post_title' => 'Inpsyde Users Test',
                'post_content' => $pageContent,
                'post_status' => 'publish',
                'post_author' => $authorId,
                'post_type' => 'page',
            ];

           $pageId = wp_insert_post($newPage);

           return $pageId;
            
        }
        do_action('inpsyde_after_create_test_page');

        return $page->ID;
    }
}

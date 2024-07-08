<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup\Tasks;

/**
 * Creates a test page for displaying content resulted from api request
 *
 * @package Inpsyde\Setup\Tasks
 * @since 1.0.1
 */

class TestPageCreator {
    public static function createTestPage(string $pageContent = ''): int {
        do_action('inpsyde_before_create_test_page');

        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

        if (!$page) {
            $pageId = self::insertTestPage($pageContent);
            do_action('inpsyde_after_create_test_page');
            return $pageId;
        }

        do_action('inpsyde_after_create_test_page');
        return $page->ID;
    }

    /**
     * Returns the default content for the test page.
     *
     * @return string The default page content.
     */
    private static function getDefaultPageContent(): string {
        return apply_filters('inpsyde_page_content', '
            <div id="inpsyde-content">
                <table id="inspyde-table"></table>
                <div class="inpsyde-single-user"></div>
            </div>
        ');
    }

    private static function insertTestPage(string $pageContent = ''): int {

        if (!$pageContent) {
            $pageContent = self::getDefaultPageContent();
        }

        $newPage = [
            'post_title' => 'Inpsyde Users Test',
            'post_content' => $pageContent,
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => 'page',
        ];

        return wp_insert_post($newPage);
    }
}
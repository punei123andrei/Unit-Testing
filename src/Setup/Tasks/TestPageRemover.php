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

class TestPageRemover {
    /**
     * Remove a test page associated with the plugin.
     */
    public static function removeTestPage() {
        $page = get_page_by_title('Inpsyde Users Test', OBJECT, 'page');

        if ($page) {
            return wp_delete_post($page->ID, true);
        }

        return false;
    }
}
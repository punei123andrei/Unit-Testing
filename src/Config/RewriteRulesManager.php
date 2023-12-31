<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Config;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Config
 * @since 1.0.1
 */

 class RewriteRulesManager 
 {
    public static function flushRules() {
        if (wp_doing_cron()) {
            return;
        }

        do_action('inpsyde_before_activate');
        flush_rewrite_rules();
        do_action('inpsyde_after_flush_rewrite_rules');
    }
}
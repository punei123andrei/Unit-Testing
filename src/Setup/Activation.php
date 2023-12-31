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

use Inpsyde\Setup\Tasks\TestPageCreator;
use Inpsyde\Config\RewriteRulesManager;

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

        RewriteRulesManager::flushRules();

        TestPageCreator::createTestPage();

    }
}

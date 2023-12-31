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

use Inpsyde\Setup\Tasks\TestPageRemover;

/**
 * Runs specific action upon deactivation
 *
 * @package Inpsyde\RequestDefinitions
 * @since 1.0.1
 */

class Deactivate
{
    /**
     * Deactivate the functionality associated with the plugin or module.
     */
    public static function deactivate()
    {
        return TestPageRemover::removeTestPage();
    }
}

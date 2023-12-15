<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Common\Abstract;

use Inpsyde\Config\Plugin;

/**
 * The Base class which can be extended by other classes to load in default methods
 *
 * @package Inpsyde\Common\Abstracts
 * @since 1.0.3
 */
abstract class Base
{
    /**
     * @var array : will be filled with data from the plugin config class
     * @see Plugin
     */
    protected $plugin = [];



    /**
     * Base constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->plugin = Plugin::init();
    }
}

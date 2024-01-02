<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup\Settings\Config;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Setup\Settings\Config
 * @since 1.0.3
 */

 interface OptionsInterface
 { 
    public function addOptionsPage(string $pageTitle, string $menuTitle,string $capability, string $menuSlug, callable $callback): void;

    public function renderOptionsPage(string $optionGroup, string $page): void;

 }
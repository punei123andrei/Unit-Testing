<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Settings\Contracts;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Settings\Contracts
 * @since 1.0.3
 */

 interface SettingsInterface
 {
    public function registerSetting(string $optionGroup, string $optionName): void;
    public function addSettingsSection(string $id, string $title, callable $callback, string $pageSlug): void;
    public function addSettingsField(string $fieldId, string $fieldTitle, callable $callback, string $pageSlug, string $id): void;
}
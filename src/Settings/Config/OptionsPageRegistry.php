<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Settings\Config;
use Inpsyde\Settings\Contracts\OptionsInterface;
/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Settings\Config
 * @since 1.0.3
 */

 class OptionsPageRegistry implements OptionsInterface
 { 

    public function getKeys($name): OptionKeys
    {
        $optionKeys = new OptionKeys();

        $settingField = str_replace(' ', '_', $name);

        return $optionKeys
            ->setOptionGroup($name . '_options')
            ->setOptionTitle($name . ' Settings')
            ->setPageSlug(sanitize_title($name) . '-settings');
    }

    public function addOptionsPage(string $pageTitle, string $menuTitle,string $capability, string $menuSlug,  callable $callback): void
    {
        add_options_page(
            $pageTitle,
            $menuTitle,
            $capability,
            $menuSlug,
            $callback
        );
    }

    public function renderOptionsPage(string $optionGroup, string $page): void 
    {
        settings_fields($optionGroup);
        do_settings_sections($page);
        submit_button();
    }

 }
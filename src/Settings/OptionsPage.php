<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Settings;
use Inpsyde\Settings\Contracts\OptionsInterface;

/**
 * Creates a test page for displaying content resulted from api request
 *
 * @package Inpsyde\Settings
 * @since 1.0.1
 */

class OptionsPage {

    private $optionsRegistry;

    public function __construct(OptionsInterface $optionsRegistry) {
        $this->optionsRegistry = $optionsRegistry;
    }

        /**
     * Add option page on admin side
     *
     * @param callable $function
     * @return void
     */
    private function actionOptionsPage(callable $function): void
    {
        add_action('admin_menu', static function () use ($function) {
            $function();
        });
    }

    /**
    * Adds an options page for the plugin to the WordPress admin menu.
    * @since 1.0.3 Adds Settings Section and settings field
    *
    * @param string $pageTitle A page title fot the settings page
    * @param string $menuTitle A title for the admin menu
    *
    * @return void
    */
    public function addOptionsPage(string $name): void
    {
        $this->actionOptionsPage(function () use ($name) {

                $pageKeys = $this->optionsRegistry->getKeys($name);

                $this->optionsRegistry->addOptionsPage(
                    $pageKeys->getOptionTitle($name),
                    $pageKeys->getOptionTitle($name),
                    'manage_options',
                    $pageKeys->getPageSlug($name),
                    [$this, 'renderOptionsPage']
                );

        });

    }

    /**
    * Renders Option Page
    * @since 1.0.3 Adds Settings Section and settings field
    *
    * @param string $pageTitle A page title fot the settings page
    * @param string $menuTitle A title for the admin menu
    *
    * @return void
    */
    public function renderOptionsPage(): void {
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                $this->optionsRegistry->renderOptionsPage(
                    'inpsyde_user_options',
                    'inpsyde-user-settings'
                );
                ?>
            </form>
        </div>
        <?php
    }
}
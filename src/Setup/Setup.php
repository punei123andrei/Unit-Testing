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

use Inpsyde\Ajax\ApiBase;

class Setup
{
    /**
     * Enqueue script on front end
     *
     * @param $function
     * @return void
     */
    private function actionEnqueueScripts(callable $function): void
    {
        add_action('wp_enqueue_scripts', static function () use ($function) {
            $function();
        });
    }

    /**
     * Add option page on admin side
     *
     * @param $function
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
    *
    * @param string $pageTitle  The title of the options page.
    * @param string $menuTitle  The text to be displayed in the menu.
    */
    public function addOptionsPage(string $pageTitle, string $menuTitle): void
    {

        $this->actionOptionsPage(function () use ($pageTitle, $menuTitle) {
                add_options_page(
                    $pageTitle,
                    $menuTitle,
                    'manage_options',
                    'inpsyde_settings',
                    [$this, 'renderOptionsPage']
                );
        });
    }

    /**
     * Renders the content for the options page.
     *
     * @return void
     */
    public function renderOptionsPage(): void
    {

        $apiBaseValue = get_option('inpsyde_api_base');
        $defaultBase = ApiBase::API_BASE;
        $apiBase = $apiBaseValue ? $apiBaseValue : $defaultBase;

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form method="post" action="">
                <?php wp_nonce_field('inpsyde_set_api', 'nonce'); ?>
                <label for="inpsyde_api_base"><?php esc_html_e('Add api:', 'inpsyde') ?></label>
                <input type="text"
                        id="inpsyde_api_base"
                        name="inpsyde_api_base"
                        value="<?php echo esc_attr($apiBase);
                        ?>">
                <?php
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Adds a style sheet for the frontend
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param string $media
     * @return $this
     */
    public function addStyle(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        string $media = 'all'
    ): Setup {

        $this->actionEnqueueScripts(static function () use ($handle, $src, $deps, $ver, $media) {
            wp_enqueue_style($handle, $src, $deps, $ver, $media);
        });

        return $this;
    }

    /**
     * Add Js script to be rendered on the front.
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param false $inFooter
     * @return $this
     */
    public function addScript(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        bool $inFooter = false
    ): Setup {

        $this->actionEnqueueScripts(static function () use ($handle, $src, $deps, $ver, $inFooter) {

            wp_register_script($handle, $src, $deps, $ver, $inFooter);
            wp_enqueue_script($handle);
        });

        return $this;
    }

    /**
     * Enqueues and localizes a script in WordPress.
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param bool $inFooter
     * @return Setup
     */
    public function localizeScript(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        bool $inFooter = false,
        ?string $pageSlug = null
    ): Setup {

        $this->actionEnqueueScripts(static function () use (
            $handle,
            $src,
            $deps,
            $ver,
            $inFooter,
            $pageSlug
        ) {

            if (
                ($pageSlug !== null)
                &&
                ($pageSlug !== get_post_field('post_name', get_queried_object_id()))
            ) {
                return;
            }

            wp_register_script($handle, $src, $deps, $ver, $inFooter);

            wp_localize_script(
                $handle,
                'ajax_obj',
                [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'token' => wp_create_nonce('inpsyde_token'),
                ]
            );

            wp_enqueue_script($handle);
        });

        return $this;
    }
}

<?php

/**
 * Inpsyde Users
 *
 * @package Inpsyde_Users
 * @author  Punei Andrei <punei.andrei@gmail.com>
 * @license GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Ajax;

use Inpsyde\Ajax\Contracts\RouteDefinition;
use Inpsyde\Ajax\Utilities\SendData;

/**
 * Processes requests defined by entities
 *
 * @package Inpsyde\RequestDefinitions
 * @since 1.0.1
 */
class AjaxRequest
{
    /**
     * @var RouteDefinition[] $requests
     */
    private $requests = [];

    /**
     * Add a RequestDefinition to the list of requests for the AjaxRequest.
     *
     * @param RouteDefinition $request The RequestDefinition object to be added.
     *
     * @return AjaxRequest Returns the current AjaxRequest instance for method chaining.
     */
    public function add(RouteDefinition $request): AjaxRequest
    {
        $this->requests[] = $request;
        return $this;
    }

    /**
     * Register all defined requests by setting up corresponding Ajax actions.
     */
    public function registerRequests(): void
    {

        foreach ($this->requests as $request) {
            $route = $request->route();
            $headers = $request->headers();
            $action = $request->action();
            $data = $request->data();

            // Trigger a custom filter hook before registering the request
            $callback = apply_filters(
                'inpsyde_ajax_callback',
                function () use ($route, $headers, $data, $action) {
                    SendData::sendAjaxResponse($route, $data, $action);
                },
                $request
            );

            $this->addAjaxAction($action, $callback);
        }
    }

    /**
     * Add an Ajax action for the specified action hook.
     *
     * @param string   $action   The unique identifier for the Ajax action.
     * @param callable $callback The callback function to be executed.
     */
    private function addAjaxAction(string $action, callable $callback): void
    {
        add_action("wp_ajax_$action", $callback);
        add_action("wp_ajax_nopriv_$action", $callback);
    }

}

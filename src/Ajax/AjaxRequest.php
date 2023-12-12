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

class AjaxRequest
{
    /**
     * @var RequestDefinition[] $requests
     */
    private $requests = [];

    /**
     * Add a RequestDefinition to the list of requests for the AjaxRequest.
     *
     * @param RequestDefinition $request The RequestDefinition object to be added.
     *
     * @return AjaxRequest Returns the current AjaxRequest instance for method chaining.
     */
    public function add(RequestDefinition $request): AjaxRequest
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
            $appendParam = $request->appendParam();

            // Trigger a custom filter hook before registering the request
            $callback = apply_filters(
                'inpsyde_ajax_callback',
                function () use ($route, $headers, $data, $appendParam, $action) {
                    $this->sendData($route, $headers, $data, $appendParam, $action);
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
    private function addAjaxAction(string $action, callable $callback)
    {
        add_action("wp_ajax_$action", $callback);
        add_action("wp_ajax_nopriv_$action", $callback);
    }

    /**
     * Send data to a specified route using an Ajax request.
     *
     * @param string $route       The target route for the Ajax request.
     * @param array  $headers     Associative array of headers to include in the request.
     * @param array  $data        Optional. Associative array of data to include in the request.
     * @param bool   $appendParam If true, appends a parameter to the route based on the
     * @param string $action      first value of the data array using RequestHelper methods.
     * 
     */
    public function sendData(
        string $route,
        array $headers,
        array $data = [],
        bool $appendParam = false,
        string $action
        )
    {
        if ($appendParam) {
            $param = reset(RequestHelper::returnPostData($data));
            $route = RequestHelper::appendParam($route, $param);
        }

        // Trigger a custom action hook before sending data
        do_action('inpsyde_before_send_ajax_data', $route, $headers, $data);


        if($action === 'inpsyde_users_list'){
            $response = RequestHelper::cachedResults($route, [], $headers, $action);
        } else {
            $response = RequestHelper::makeGetRequest($route, [], $headers);
        }
        
        wp_send_json($response);

        // Trigger a custom action hook after sending data
        do_action('inpsyde_after_send_ajax_data', $response);
    }
}

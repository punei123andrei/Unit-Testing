<?php 

/**
 * Inpsyde Users
 *
 * @package Inpsyde_Users
 * @author  Punei Andrei <punei.andrei@gmail.com>
 * @license GNU General Public License v3.0
 *
 */

declare(strict_types=1);

namespace Inpsyde\Ajax;

class AjaxRequest
{
    /**
     * @var RequestDefinition[] $requests
     */
    private $requests = [];

    public function add(RequestDefinition $request): AjaxRequest
    {
        $this->requests[] = $request;
        return $this;
    }

    public function registerRequests(): void
    {
        foreach ($this->requests as $request) {
            $route = $request->route();
            $headers = $request->headers();
            $action = $request->action();
            $data = $request->data();
            $appendParam = $request->appendParam();

            // Trigger a custom filter hook before registering the request
            $callback = apply_filters('inpsyde_ajax_callback', function () use ($route, $headers, $data, $appendParam) {
                $this->sendData($route, $headers, $data, $appendParam);
            }, $request);

            $this->addAjaxAction($action, $callback);
        }
    }

    private function addAjaxAction(string $action, callable $callback)
    {
        add_action("wp_ajax_$action", $callback);
        add_action("wp_ajax_nopriv_$action", $callback);
    }

    public function sendData(string $route, array $headers, array $data = [], bool $appendParam = false)
    {
        if ($appendParam) {
            $param = reset(RequestHelper::returnPostData($data));
            $route = RequestHelper::appendParam($route, $param); 
        }

        // Trigger a custom action hook before sending data
        do_action('inpsyde_before_send_ajax_data', $route, $headers, $data);

        $response = RequestHelper::makeGetRequest($route, [], $headers);
        wp_send_json($response);

        // Trigger a custom action hook after sending data
        do_action('inpsyde_after_send_ajax_data', $response);
    }
}

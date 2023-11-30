<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Ajax;

class SendRequest
{
    /**
	 * @var RequestDefinition[] $requests
	 */
	private $requests = [];

	public function add( RequestDefinition $request ) 
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
            $callback = function () use ($route, $headers, $data) {
                $this->sendData($route, $headers, $data);
            };
            $this->addAjaxAction($action, $callback);
		}
	}

    private function addAjaxAction($action, $callback)
    {
        add_action("wp_ajax_$action", $callback);
        add_action("wp_ajax_nopriv_$action", $callback);
    }

    public function sendData(string $route, array $headers, string $data)
    {
        $token = ApiRequest::handleAjaxRequest();
        if(ApiRequest::getPostData())
        $response = ApiRequest::makeGetRequest($route, [], $headers);
        wp_send_json($response);
    }
    public function singleUser()
    {
        $token = ApiRequest::handleAjaxRequest();

        $userId = isset($_POST['userId']) ? sanitize_text_field(wp_unslash($_POST['userId'])) : '';
        $userProfile = '/users/' . $userId;

        $url = ApiUsers::baseUrl($userProfile);
        $headers = ApiUsers::headers();
        $response = self::makeGetRequest($url, [], $headers);
            wp_send_json($response);
    }
}

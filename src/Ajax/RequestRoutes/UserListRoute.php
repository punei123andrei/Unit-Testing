<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Ajax\RequestRoutes;

use Inpsyde\Ajax\Utilities\ApiBase;
use Inpsyde\Ajax\Contracts\RouteDefinition;

/**
 * Defines an object to be executed by the AjaxRequest class
 *
 * @package Inpsyde\Ajax\RequestDefinitions
 * @since 1.0.1
 */

class UserListRoute implements RouteDefinition
{
    /**
     * Route.
     * @return string
     */
    public function route(): string
    {
        return ApiBase::baseUrl('/users');
    }

    /**
     * Headers.
     * @return array
     */
    public function headers(): array
    {
        return ApiBase::headers();
    }

    /**
     * Action
     * @return string
     */
    public function action(): string
    {
        return 'inpsyde_users_list';
    }

    /**
     * Data to be sent with the request.
     * @return array
     */
    public function data(): array
    {
        return [];
    }

}

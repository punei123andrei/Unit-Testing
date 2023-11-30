<?php
namespace Fiald\CPTs;

class DefinitionUserList implements RequestDefinition 
{
    /**
	 * Route.
	 * @return string
	 */
	public function route(): string 
    {
        return ApiUsers::baseUrl('/');
    }

	/**
	 * Headers.
	 * @return array
	 */
	public function headers(): array 
    {
        return ApiUsers::headers();
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
    public function data(): array {
        return [];
    }

}
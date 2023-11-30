<?php
namespace Fiald\CPTs;

class DefinitionSingleUser implements RequestDefinition 
{
	/**
	 * Route.
	 * @return string
	 */
	public function route(): string 
    {
        return ApiUsers::baseUrl('/users');
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
        return ['userId'];
    }
}
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

interface RequestDefinition {

	/**
	 * Route.
	 * @return string
	 */
	public function route(): string;

	/**
	 * Headers.
	 * @return array
	 */
	public function headers(): array;

	/**
	 * The Ajax action that will trigger the function
	 * @return string
	 */
	public function action(): string;

	/**
     * Data to be sent with the request.
     * @return array
     */
    public function data(): array;

}
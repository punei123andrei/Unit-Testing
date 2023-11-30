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
	 * Action
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/
	 * @return array
	 */
	public function action(): array;

}
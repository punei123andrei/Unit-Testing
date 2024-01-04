<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

 declare(strict_types=1);

namespace Inpsyde\Ajax\ClassMapping;
use Inpsyde\Ajax\Contracts\UserMapInterface;

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax\ClassMapping
 * @since 1.0.1
 */

 class UserMap {

	private string $email;
	private string $first;
	private string $last;
	private string $country;

	/**
	 * @param string $first
	 *
	 * @return UserMap
	 */
	public function set_name( string $first ): UserMap {
		$this->first = $first;

		return $this;
	}

	/**
	 * @param string $last
	 *
	 * @return UserMap
	 */
	public function setLast( string $last ): UserMap {
		$this->last = $last;

		return $this;
	}

	/**
	 * @param string $country
	 *
	 * @return UserMap
	 */
	public function setCountry( string $country ): UserMap {
		$this->country = $country;

		return $this;
	}

	/**
	 * @param string $email
	 *
	 * @return UserMap
	 */
	public function setEmail( string $email ): UserMap {
		$this->email = $email;

		return $this;
	}

	public function asWpUser() : \WP_User {
		$wp_user = new \WP_User();

		$wp_user->user_email = $this->email;
		$wp_user->first_name = $this->first;
		$wp_user->last_name  = $this->last;

		$wp_user->locale = $this->country;

		return $wp_user;
	}

}
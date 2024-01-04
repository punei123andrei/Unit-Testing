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

 class UserCollection implements \Iterator, \Countable
 {

    private $users = [];

    public function add(\WP_User $user) 
    {
      $this->users = $user;
    }

       // Returns the current WP_User object
    public function current(): \WP_User 
    {
        return current($this->users);
    }

    // Move forward to next WP_User object
    public function next(): void 
    {
        return next($this->users);
    }

    // Returns the current position (key)
    public function key(): int 
    {
        return key($this->users);
    }

     // Checks if current position is valid
     public function valid(): bool 
     {
        return key($this->users) !== null;
    }

    // Rewind back to the first WP_User object
    public function rewind(): void 
    {
        return reset($this->users);
    }

    public function count(): int 
    {
        return count($this->users);
    }
 }
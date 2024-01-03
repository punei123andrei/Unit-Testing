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

/**
 * To do, sending object instead of arrays aligned with WP principles
 *
 * @package Inpsyde\Ajax
 * @since 1.0.1
 */

 class Requester 
 {


    public function makeGetRequest(){
        $args['method'] = 'GET';

        $instance = new self();
        $instance->set_args($args);
    
        return $instance;
    }

    /**
     * Check if the API endpoint is reachable.
     *
     * @param string $url
     *
     * @return bool
     */
    public function isApiReachable(string $url):bool {

        $response = wp_remote_head($url);

        if (is_wp_error($response)) {
            return false;
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        return $responseCode === 200;
    }

    private function mapResponse(){
        
    }

    /**
    * Sets the request method as `GET`.
    *
    * @param array $args
    * @return Request
    */
   public static function GET(array $args = []){

    $args['method'] = 'GET';

    $instance = new self();
    $instance->set_args($args);

    return $instance;
 }

    /**
    * Create the booking product
    *
    * @param array $args
    * @return bool
    * @throws \Exception
    */
    public function create_entries(array $args = []) {

        $booking_product = new Service_Nexus_API_Booking_Products_Entity($args);
  
        $response = Request::POST([
           'headers' => $this->headers(
              [
                 'Content-type' => 'application/json'
              ]
           ),
           'timeout' => 30,
           'body' => json_encode( $args )
        ])->send($this->base_url('/spaces/bookingproducts'));
  
        if($response->status == 200){
  
           return $response->body->Value;
  
        }
  
        return false;
     }
 }
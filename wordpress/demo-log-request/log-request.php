<?php
/**
 * @package Demo_Log_Request
 * @version 0.1
 */
/*
Plugin Name: Demo Log Request
Plugin URI: https://wordpress.org/plugins/demo-log-request/
Description: Logs request information
Author: dbierer
Version: 0.1
Author URI: http://unlikelysource.com/
*/

class DemoLogRequest
{
    public static function logRequest($query)
    {
    }
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'parse_request', 'DemoLogRequest::logRequest' );

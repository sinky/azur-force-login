<?php
/*
Plugin Name: Azur Force Login
Plugin URI: http://my-azur.de
Description: Force Login for everything
Version: 1.0
Author: Marco Krage
Author URI: http://my-azur.de
*/

function azur_forcelogin() {
  if ( !is_user_logged_in() ) {
    auth_redirect();
  }
}
add_action('template_redirect', 'azur_forcelogin');
<?php
/*
Plugin Name: Azur Force Login
Plugin URI: https://github.com/sinky/azur-force-login
Description: Force Login for everything. Closed/Private Wordpress.
Version: 2.0
Author: Marco Krage
Author URI: https://my-azur.de
*/

/*
  - In single.php bei the_post_navigation eine 'is_user_logged_in' abfrage um next/prev Beitrag zu verstecken
  - In content.php bei meta einen "Öffentlichen Link" mit "azur_forcelogin_get_postlink()" hinzugefügt
*/

function azur_forcelogin_get_postsecret() {
  $postdata = get_post();
  return md5($postdata->post_title.$postdata->post_modified);
}

function azur_forcelogin_get_postlink() {
  if ( is_user_logged_in() ) {
    return '<span class="azur-force-login-public-link"><a href="'.get_permalink().'?azurpostsecret='.azur_forcelogin_get_postsecret().'" target="_blank">Öffentlicher Link</a></span>';
  }
}

function azur_forcelogin() {
  if(is_single() && $_GET['azurpostsecret'] == azur_forcelogin_get_postsecret()) {
    $GLOBALS['wp_query']->max_num_pages = 0;
    return true;
  }elseif ( is_user_logged_in() ) {
    return true;
  }
  auth_redirect();
}
add_action('template_redirect', 'azur_forcelogin');

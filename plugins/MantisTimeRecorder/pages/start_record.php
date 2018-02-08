<?php

/**
 * Update bug spent time then redirect to the appropriate viewing page
 *
 * @package MantisBT
 *
 * @uses core.php
 * @uses access_api.php
 * @uses authentication_api.php
 * @uses bug_api.php
 * @uses bugnote_api.php
 * @uses config_api.php
 * @uses constant_inc.php
 * @uses custom_field_api.php
 * @uses email_api.php
 * @uses error_api.php
 * @uses event_api.php
 * @uses form_api.php
 * @uses gpc_api.php
 * @uses helper_api.php
 * @uses history_api.php
 * @uses lang_api.php
 * @uses print_api.php
 * @uses relationship_api.php
 */

require_once( 'core.php' );
require_api( 'access_api.php' );
require_api( 'authentication_api.php' );
require_api( 'bug_api.php' );
require_api( 'bugnote_api.php' );
require_api( 'config_api.php' );
require_api( 'constant_inc.php' );
require_api( 'custom_field_api.php' );
require_api( 'email_api.php' );
require_api( 'error_api.php' );
require_api( 'event_api.php' );
require_api( 'form_api.php' );
require_api( 'gpc_api.php' );
require_api( 'helper_api.php' );
require_api( 'history_api.php' );
require_api( 'lang_api.php' );
require_api( 'print_api.php' );
require_api( 'relationship_api.php' );

//form_security_validate( 'bug_update' );

//read form data
$f_bug_id = gpc_get_int( 'bug_id' );
$f_text = gpc_get_string('text');
//add checkbox for private

//get the current user id 
$t_current_user_id = auth_get_current_user_id();

//add a note
$t_bugnote_id = bugnote_add( $f_bug_id, $f_text, '00:00', VS_PUBLIC, BUGNOTE,
/* attr */ '', /* user_id */ $t_current_user_id, /* send_email */ false );

//redirect to the bug page
print_successful_redirect_to_bug( $f_bug_id );
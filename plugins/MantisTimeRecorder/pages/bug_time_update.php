<?php

/**
 * Update bug spent time then redirect to the appropriate viewing pagE
 */

require_api( 'bug_api.php' );
require_api( 'bugnote_api.php' );

//read form data
$f_bug_id = gpc_get_int( 'bug_id' );
$f_time_hours = gpc_get_int('time_hours');
$f_time_minutes = gpc_get_int('time_minutes');
$f_comment = gpc_get_string('time_comment');
//add checkbox for private

//get the bug object
$t_existing_bug = bug_get( $f_bug_id, true );
//TODO: add check if exist

//get the current user id 
$t_current_user_id = auth_get_current_user_id();

//note text 
$t_note_text = ($f_comment == '') ? 'Time Tracking' : $f_comment;
$t_track = $f_time_hours .':'. $f_time_minutes;

//add a note
$t_bugnote_id = bugnote_add( $f_bug_id, $t_note_text, $t_track, 
                            /*$p_private*/ false, 
                            /*$p_type*/ BUGNOTE, 
                            /*$p_attr*/ '', 
                            /*$p_user_id*/ $t_current_user_id, 
                            /*$p_send_email*/ false );

                            //redirect to the bug page
print_successful_redirect_to_bug( $f_bug_id );
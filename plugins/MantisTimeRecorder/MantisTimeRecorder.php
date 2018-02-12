<?php

# MantisTimeRecorder - a live time recorder plugin for MantisBT
#

#if( !defined( 'MANTIS_VERSION' ) ) { exit(); }
require_api( 'helper_api.php' );

class MantisTimeRecorderPlugin extends MantisPlugin {

    # Plugin definition
	function register() {
		$this->name         = plugin_lang_get( 'title' );
		$this->description  = plugin_lang_get( 'description' );
		$this->page         = 'config_page';

		$this->version      = '1.0.0';
		$this->requires = array(
			'MantisCore' => '2.0.0',
		);

		$this->author       = 'Andrea Boggia <bladep911>';
		$this->contact      = 'andrea.boggia@gmail.com';
		$this->url          = '';
	}

    # Plugin configuration
	function config() {
		return array(
            #'access_threshold'  => DEVELOPER, // Set global access level requireed to access plugin
			'foo_or_bar' => 'foo'
		);
	}

	# Schema definition
	function schema() {
		return array(
			array( 'CreateTableSQL', array( plugin_table('data'), "
				id                  I       NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
				bug_id              I       NOTNULL UNSIGNED,
				user_id             I       NOTNULL UNSIGNED,
				time				I		NOTNULL DEFAULT 0 UNSIGNED
				" )
			),
		);
	}
	
	/**
	 * Include javascript and css
	 * @return void
	 */
	function resources() {
		$project_id = helper_get_current_project();
		if ( is_page_name( 'view.php' ) && ($project_id >= 6 && $project_id <= 9) ) {
			//prefilter only for bug detail page
			echo '<script src="' . plugin_file('bootbox.min.js') . '"></script>';
			echo '<script src="' . plugin_file('flipclock.js') . '"></script>';
			echo '<script src="' . plugin_file('mantis-time-recorder.js') . '"></script>';
			echo '<link rel="stylesheet" type="text/css" href="' . plugin_file('flipclock.css') . '" />';
			echo '<link rel="stylesheet" type="text/css" href="' . plugin_file('mantis-time-recorder.css') . '" />';
		}
	}
	
	# Add start menu item
	function showreport_menu() {
        #if ( access_has_global_level( plugin_config_get( 'access_threshold' ) ) ) {
            return array(
                array( 
                    'title'         => plugin_lang_get( 'title' ),
                    #'access_level'  => plugin_config_get( 'access_threshold' ),
                    'url'           => 'plugin.php?page=MantisTimeRecorder/start_page',
                    'icon'          => 'fa-space-shuttle'
                ),
            );
		#}
	}
	
	function events() {
        return array(
            'EVENT_EXAMPLE_FOO' => EVENT_TYPE_EXECUTE,
            'EVENT_EXAMPLE_BAR' => EVENT_TYPE_CHAIN,
        );
    }
	
	function flipclock($event, $bugid){
		$project_id = helper_get_current_project();
		if ($project_id >= 6 && $project_id <= 9) {
			echo'<div class="row">
				<div class="clock col-md-5" style="margin:2em;"></div>
				<button type="button" class="btn btn-success btn-run">
					<span class="glyphicon glyphicon-play" aria-hidden="true"></span> 
					<span class="start-text"></span>
				</button>
				<button type="button" class="btn btn-default btn-save" data-bugid="'. $bugid .'">
					<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
					<span class="save-text"></span>
				</button>
				</div>';
		}
	}
	
	function hooks() {
        return array(
			'EVENT_LAYOUT_RESOURCES' => 'resources',
			'EVENT_MENU_MAIN' => 'showreport_menu',
            'EVENT_EXAMPLE_FOO' => 'foo',
            'EVENT_EXAMPLE_BAR' => 'bar',
			'EVENT_VIEW_BUG_DETAILS' => 'flipclock'
        );
    }
	
	function foo( $p_event ) {
        echo 'In method foo(). ';
    }

    function bar( $p_event, $p_chained_param ) {
        return str_replace( 'foo', 'bar', $p_chained_param );
    }
}
?>

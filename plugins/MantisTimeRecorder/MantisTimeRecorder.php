<?php

# MantisTimeRecorder - a live time recorder plugin for MantisBT
#

#if( !defined( 'MANTIS_VERSION' ) ) { exit(); }

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
	
	function wurst($event, $bugid){
		echo 'wurst '.$bugid ;
	}
	
	function hooks() {
        return array(
			'EVENT_MENU_MAIN' => 'showreport_menu',
            'EVENT_EXAMPLE_FOO' => 'foo',
            'EVENT_EXAMPLE_BAR' => 'bar',
			'EVENT_VIEW_BUG_DETAILS' => 'wurst'
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


<?php
	#header
	if( !defined( 'MANTIS_VERSION' ) ) { exit(); }
	layout_page_header( plugin_lang_get( 'title' ) );
	layout_page_begin();
?>

<div id="wrapper">
<?php
	#content
	echo '<p>Welcome to <a href="', plugin_page( 'start_page' ), '"> time recorder start page</a>.</p>';

	echo '<p class="foo">';
	event_signal( 'EVENT_EXAMPLE_FOO' );

	$t_string = 'A sentence with the word "foo" in it.';
	$t_new_string = event_signal( 'EVENT_EXAMPLE_BAR', array( $t_string ) );

	echo $t_new_string, '</p>';
?>
</div>

<?php layout_page_end(); 
	#footer
?>


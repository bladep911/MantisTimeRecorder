<php
class ExamplePlugin extends MantisPlugin {
    function register() {
        $this->name = 'Time Recorder';    # Proper name of plugin
        $this->description = 'Live time recorder for tasks';    # Short description of the plugin
        $this->page = '';           # Default plugin page

        $this->version = '1.0';     # Plugin version string
        $this->requires = array(    # Plugin dependencies
            'MantisCore' => '2.0',  # Should always depend on an appropriate
                                    # version of MantisBT
        );

        $this->author = 'Bladep911';         # Author/team name
        $this->contact = 'andrea.boggia@gmail.com';        # Author/team e-mail address
        $this->url = '';            # Support webpage
    }
}

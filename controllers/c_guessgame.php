<?php
class guess_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
    } 

    public function practice() {
        # Set up the view
        $this->template->content = View::instance('v_guess_number_p');

        # Load JS files
            $client_files_body = Array(
                "/js/number_game.js"
            );

            $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render the view
        echo $this ->template;
    }

   
        
        
} # end of the class
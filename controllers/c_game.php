<?php
class numbergame_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
    } 

    public function gameroom() {
          # if user is blank, then they're not logged in - redirect to login
        if (!$this->user) {
            router::redirect('/users/login');
        }
         # Set up the View
            $this->template->content = View::instance("v_numbergame_gameroom");
            $this->template->title   = "Users";

            # Build the query to get all the users
            $q = "SELECT *
                FROM users
                WHERE user_id != ".$this->user->user_id;

            # Execute the query to get all the users. 
            # Store the result array in the variable $users
            $users = DB::instance(DB_NAME)->select_rows($q);

            # Pass data (users) to the view
            $this->template->content->users       = $users;

             # Render the view
            echo $this->template;

    }

    public function onlineplay($opponent_player_id) {

        # if user is blank, then they're not logged in - redirect to login
        if (!$this->user) {
            router::redirect('/users/login');
        }
        # Set up the view
        $this->template->content = View::instance('v_game1_onlineplay');

        # Load JS files
        $client_files_body = Array(
            "/js/pubnub.js",
            "/js/game1_onlineplay.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);  
        $this->template->content->opponent_player_id = $opponent_player_id; 
        $this->template->content->this_player_id = $this->user->user_id;        

        # Render the view
        echo $this ->template;
    }

   
        
        
} # end of the class
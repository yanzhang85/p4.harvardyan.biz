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
       
        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("gameroom" => 1);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

         # Set up the View
        $this->template->content = View::instance("v_numbergame_gameroom");
        $this->template->title   = "Gameroom";

        # Build the query to get all the users
        $q = "SELECT *
            FROM users
            WHERE gameroom = 1 AND user_id != ".$this->user->user_id;

        # Execute the query to get all the users. 
        # Store the result array in the variable $users
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Pass data (users) to the view
        $this->template->content->users       = $users;

        $client_files_body = Array(
            "/js/pubnub.js",
            "/js/jquery.form.js",
            "/js/numbergame_invitation.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);  

        $this->template->content->this_player_id = $this->user->user_id;


        # Render the view
        echo $this->template;

    }

/*
    Public function p_gameroom(){
        $view = View::instance("v_numbergame_P_gameroom");
        
        $invitor_id = $_POST['invitor_id'];

        $i = "SELECT *
            FROM users
            WHERE user_id = ".$invitor_id;

        $invitor= DB::instance(DB_NAME)->select_rows($i);

        $view->invitor       = $invitor;

        echo $view;

    }
*/


    public function onlineplay($opponent_player_id) {

        # if user is blank, then they're not logged in - redirect to login
        if (!$this->user) {
            router::redirect('/users/login');
        }

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("gameroom" => 0);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

        # Set up the view
        $this->template->content = View::instance('v_numbergame_onlineplay');

        # Load JS files
        $client_files_body = Array(
            "/js/pubnub.js",
            "/js/numbergame_onlineplay.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);  
        $this->template->content->opponent_player_id = $opponent_player_id; 
        $this->template->content->this_player_id = $this->user->user_id;        

        # Render the view
        echo $this ->template;
    }

   
        
        
} # end of the class
<?php
class chat_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        # Make sure user is logged in if they want to use anything in this controller
            if (!$this->user) {
                router::redirect('/users/login');
            }
        
    } 

    public function room() {
          
        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("chatroom" => 1);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

         # Set up the View
        $this->template->content = View::instance("v_chatroom");
        $this->template->title   = "Chatroom";

        # Build the query to get all the users
        $q = "SELECT *
            FROM users
            WHERE chatroom = 1 AND user_id != ".$this->user->user_id;

        # Execute the query to get all the users. 
        # Store the result array in the variable $users
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Pass data (users) to the view
        $this->template->content->users       = $users;

        $client_files_body = Array(
            "/js/pubnub.js",
            "/js/chatroom.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);  

        $this->template->content->this_user_firstname = $this->user->first_name;
        $this->template->content->this_user_lastname = $this->user->last_name;


        # Render the view
        echo $this->template;

    }
}
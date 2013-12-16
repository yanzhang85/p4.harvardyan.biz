<?php
class game_controller extends base_controller {

    public function __construct() {
        parent::__construct();

         if (!$this->user) {
            router::redirect('/users/login');
        }

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("chatroom" => 0);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");     
    } 

    public function homepage() {
        # Set up the view
        $this->template->content = View::instance('v_guessgame_practice');

        # Load JS files
            $client_files_body = Array(
                "/js/guessgame.js"
            );

            $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render the view
        echo $this ->template;
    }

    public function gamerecord(){
        # Setup view
            $this->template->content = View::instance('v_game_gamerecord');
            $this->template->title   = "Gamerecord";

        # JavaScript files
            $client_files_body = Array(
                '/js/jquery.form.js', 
                '/js/gamerecord.js');
            $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
            echo $this->template;
    }

    public function p_gamerecord() {

        $data = $game_record =Array();
        
        # Find out how many posts there are
        $q = 'SELECT * FROM gamerecord where user_id = '.$this->user->user_id;
        $game_record = DB::instance(DB_NAME)->select_rows($q);
        $data['you_score'] = $game_record[0]['guess_score'];
        $data['you_score_time'] = $game_record[0]['score_timecreated'];
        $data['you_time'] = $game_record[0]['guess_time'];
        $data['you_time_time'] = $game_record[0]['time_timecreated'];
        

        # Find out how many users there are
        $q = "SELECT max(guess_score) FROM gamerecord";
        $data['all_score'] = DB::instance(DB_NAME)->select_field($q);

        $q = "SELECT max(guess_time) FROM gamerecord";
        $data['all_time'] = DB::instance(DB_NAME)->select_field($q);

        # Send back json results to the JS, formatted in json
        echo json_encode($data);
    }
        
} # end of the class


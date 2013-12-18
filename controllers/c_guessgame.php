<?php
class guessgame_controller extends base_controller {

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

    public function practice() {
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

    public function scoremode() {
        # Set up the view
        $this->template->content = View::instance('v_guessgame_scoremode');

        $q = 'SELECT *
                FROM gamerecord
                WHERE user_id = '.$this->user->user_id;

        $game_record = DB::instance(DB_NAME)->select_rows($q);

        # Load JS files
            $client_files_body = Array(
                 "/js/jquery.form.js",
                 "/js/guessgame.js",
                 "/js/posts_add.js"
            );

        $this->template->client_files_body = Utils::load_client_files($client_files_body); 
        $this->template->content->game_record = $game_record;

        # Render the view
        echo $this ->template;
    }
   
    public function timemode() {
        # Set up the view
        $this->template->content = View::instance('v_guessgame_timemode');
        # Load JS files
            $client_files_body = Array(
                 "/js/jquery.form.js",
                 "/js/guessgame.js",
                 "/js/posts_add.js"
            );

        $q = 'SELECT *
                FROM gamerecord
                WHERE user_id = '.$this->user->user_id;

        $game_record = DB::instance(DB_NAME)->select_rows($q);


        $this->template->client_files_body = Utils::load_client_files($client_files_body); 
        $this->template->content->game_record = $game_record;

        # Render the view
        echo $this ->template;
    }   


    public function scoreadd($score){
        # process the upload
            $data = Array(
                "guess_score" => $score,
                "score_timecreated" => Time::now()
            );
        DB::instance(DB_NAME)->update("gamerecord", $data, "WHERE user_id = ".$this->user->user_id);


    }

    public function timeadd($time){
        # process the upload
            $data = Array(
                "guess_time" => $time,
                "time_timecreated" => Time::now()
            );
        DB::instance(DB_NAME)->update("gamerecord", $data, "WHERE user_id = ".$this->user->user_id);


    }
        
} # end of the class


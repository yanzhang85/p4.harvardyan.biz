<?php
    class posts_controller extends base_controller {

        public function __construct() {
            parent::__construct();

            # Make sure user is logged in if they want to use anything in this controller
            if(!$this->user) {
                router::redirect('/users/login');
            }
            # Create the data array we'll use with the update method
            # In this case, we're only updating one field, so our array only has one entry
            $data = Array("chatroom" => 0);

            # Do the update
            DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
        }
        // display a new post form
        public function add() {

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("chatroom" => 0);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");


            # Setup view
            $this->template->content = View::instance('v_posts_add');
            $this->template->title   = "New Post";

            # Load JS files
            $client_files_body = Array(
                "/js/jquery.form.js",
                "/js/posts_add.js"
            );

            $this->template->client_files_body = Utils::load_client_files($client_files_body);   

            # Render template
            echo $this->template;

        }

        public function p_add() {

            # blank post is not allowed.
            if (!$_POST['content']) {
                
                echo "Please share your interesting things with us (at least one character is required). <br><a href='/posts/add'>Go back</a>";
                
            } else {


            # Associate this post with this user
            $_POST['user_id']  = $this->user->user_id;

            # Unix timestamp of when this post was created / modified
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

            # Insert
            # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
            DB::instance(DB_NAME)->insert('posts', $_POST);
            
            # Quick and dirty feedback
            //echo "Your post has been added. <br><a href='/posts/add'>What about one more?</a> <br> <a href='/'>Back to main page</a>";
        
            $view = new View('v_posts_p_add');
            $view -> created = Time::display(Time::now());
            echo $view;
        }

        }
         public function index() {

            

            # Set up the View
            $this->template->content = View::instance('v_posts_index');
            $this->template->title   = "Posts";

            # Build the query
            $q = 'SELECT 
                    posts.content,
                    posts.created,
                    posts.user_id AS post_user_id,
                    users_users.user_id AS follower_id,
                    users.first_name,
                    users.last_name,
                    users.image
                FROM posts
                INNER JOIN users_users 
                    ON posts.user_id = users_users.user_id_followed
                INNER JOIN users 
                    ON posts.user_id = users.user_id
                WHERE users_users.user_id = '.$this->user->user_id .'
                ORDER BY posts.created DESC';


            # Run the query
            $posts = DB::instance(DB_NAME)->select_rows($q);

            # Pass data to the View
            $this->template->content->posts = $posts;

            # Render the View
            echo $this->template;

            }


        
        
        public function users() {


            # Set up the View
            $this->template->content = View::instance("v_posts_users");
            $this->template->title   = "Users";

            # Build the query to get all the users
            $q = "SELECT *
                FROM users
                WHERE user_id != ".$this->user->user_id;

            # Execute the query to get all the users. 
            # Store the result array in the variable $users
            $users = DB::instance(DB_NAME)->select_rows($q);

            # Build the query to figure out what connections does this user already have? 
            # I.e. who are they following
            $q = "SELECT * 
                FROM users_users
                WHERE user_id = ".$this->user->user_id;

            # Execute this query with the select_array method
            # select_array will return our results in an array and use the "users_id_followed" field as the index.
            # This will come in handy when we get to the view
            # Store our results (an array) in the variable $connections
            $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

            # Pass data (users and connections) to the view
            $this->template->content->users       = $users;
            $this->template->content->connections = $connections;

            # Render the view
            echo $this->template;
            }    


        public function follow($user_id_followed) {

            # Prepare the data array to be inserted
            $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
            );

            # Do the insert
            DB::instance(DB_NAME)->insert('users_users', $data);

            # Send them back
            Router::redirect("/posts/users");

        }

        public function unfollow($user_id_followed) {

            # Delete this connection
            $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
            DB::instance(DB_NAME)->delete('users_users', $where_condition);

            # Send them back
            Router::redirect("/posts/users");

        }


    }
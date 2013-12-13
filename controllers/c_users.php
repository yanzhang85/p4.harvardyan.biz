<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
    } 

    public function index() {
        # Set up the view
        $this->template->content = View::instance('v_index_index');
        # Render the view
        echo $this ->template;
    }

    public function signup() {
            # Set up the view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Sign up";


        # Render the view
        if(!$_POST){
            echo $this->template;
            return;
        }   

    }

       
    public function p_signup($error=NULL) {

        $this->template->content=View::instance('v_users_signup');
        $this->template->title = "Sign Up";
            
        # initiate error to false
        $error = false;

        #  initiate error
        $this->template->content->error = '';

        # check POST data for valid input
        foreach($_POST as $field_name => $value){
            # Escape HTML chars (XSS attacks)
            $value = stripslashes(htmlspecialchars($value));
            # if an field is blank, add a message to the error view variable
            if (trim($value) == ""){
                $error = true;
                $this->template->content->error = '<p>All fields are required.</p>';
            }
        }
        if ($error) {
            echo $this->template;
        }
        # email address format validation
        else if (!(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$_POST['email']))) {
            $error = true;
            $this->template->content->error = '<p>Please input a valid email addreess.</p>';
            echo $this->template;
        }
       # check whether the email address already exists
        else {   
            $_POST = DB::instance(DB_NAME) ->sanitize($_POST);
            $exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");

            if (isset($exists)) {
                $error = true;
                $this->template->content->error = '<p>This email is already registered. You could <a href="/users/login">login</a> instead.</p>';
                echo $this->template;
            }

            # ensure password is typed correctly
            else if ($_POST['password'] != $_POST['retype']) {
                $error= true;
                $this->template->content->error = '<p> Password fields don&apos;t match.</p>';
                echo $this->template;

            }
            #unset the 'retype' field (no need any more)
            else {
                unset($_POST['retype']);
                # Dump out the results of POST to see what the form submitted
                // print_r($_POST);

                # Insert this user into the database
                
                $_POST['created'] = Time::now();
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                $_POST['token']  = $token = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
                $_POST['image']='placeholder.jpg';

                $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

                # all users follow their own posts by default
                $data = Array(
                    "created" => Time::now(),
                    "user_id" => $user_id,
                    "user_id_followed" => $user_id
                    );

                # Do the insert
                DB::instance(DB_NAME)->insert('users_users', $data);

                # Store this token in a cookie using setcookie()
                setcookie("token", $token, strtotime('+1 year'), '/');

                    
                $to[]= Array("name" => $_POST['first_name'].$_POST['last_name'], "email" => $_POST['email']);
                //$to[]= Array("name" => APP_NAME, "email" => "hawk8513@gmail.com");
                $from[]= Array("name" => APP_NAME, "email" => APP_EMAIL);
                $subject = "Welcome to Netchat!";
                $body = View::instance('v_email_example');
                    

                # Send email
                Email::send($to,$from,$subject,$body,true,'','');

                # Send them to the main page 
                Router::redirect("/users/profile");
            }
        }
    }


                  
      
    public function p_login() {

        if (!$_POST) {
            echo $this->template;
            return;
        } else {

            # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);

            # Escape HTML chars (xss attack)
            $_POST['email'] = stripslashes(htmlspecialchars($_POST['email']));

            # Hash submitted password so we can compare it against one in the db
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

            # Search the db for this email and password
            # Retrieve the token if it's available
            $q = "SELECT token 
                FROM users 
                WHERE email = '".$_POST['email']."' 
                AND password = '".$_POST['password']."'";

            $token = DB::instance(DB_NAME)->select_field($q);

            # Search the db for this email 
            # Retrieve the id if it's available
            $n = "SELECT user_id 
                    FROM  users 
                    WHERE email =  '".$_POST['email']."'";

            $user_id = DB::instance(DB_NAME)->select_field($n);

       


            # If we didn't find a matching token in the database, it means login failed
            if(!$token) {

                
                
                    # If we didn't find a matching id in the database
                if(!$user_id) {

                    # Send them back to the login page and tell them that email is not correct.
                    Router::redirect("/users/login/error1");

                    # If we did find a matching id in the database
                } else {
                    # Send them back to the login page and tell them that account is not correct.
                    Router::redirect("/users/login/error2");
                }
                               

            # But if we did, login succeeded! 
            } else {

                /* 
                Store this token in a cookie using setcookie()
                Important Note: *Nothing* else can echo to the page before setcookie is called
                Not even one single white space.
                param 1 = name of the cookie
                param 2 = the value of the cookie
                param 3 = when to expire
                param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
                */
                setcookie("token", $token, strtotime('+1 year'), '/');

                # Send them to the main page - or whever you want them to go
                Router::redirect("/");

            }
        }
    }

    public function login($error = NULL) {

        # Set up the view
        $this->template->content = View::instance("v_users_login");
        $this->template->title = "Log in";

        # Pass data to the view
       
        $this->template->content->error = $error;

        # Render the view
        echo $this->template;

    }




    public function logout() {
        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("gameroom" => 0);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");


        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");
    }

    public function profile($error = NULL) {

        # if user is blank, then they're not logged in - redirect to login
        if (!$this->user) {
            router::redirect('/users/login');
        }

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("gameroom" => 0);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");

        # pass the profile view to the 'content' area of the master template
        $this->template->content = View::instance('v_users_profile');
    
        # title for this page 
        $this->template->title = $this->user->first_name . " " . $this->user->last_name;

        # pass errors, if any
        $this->template->content->error = $error;

        //render the view 
        echo $this->template;
    }

    public function profile_update() {
        # if user specified a new image file, upload it
        if ($_FILES['avatar']['error'] == 0)
        {
            # upload an image
            $image = Upload::upload($_FILES, "/uploads/avatars/", array("JPG", "JPEG", "jpg", "jpeg", "gif", "GIF", "png", "PNG"), $this->user->user_id);

            if($image == 'Invalid file type.') {
                # return an error
                Router::redirect("/users/profile/error"); 
            }
            else {
                # process the upload
                $data = Array(
                    "image" => $image,
                    "modified" => Time::now()
                    );
                DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);

                # resize the image
                $imgObj = new Image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $image);
                $imgObj->resize(50,50);
                $imgObj->save_image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars' . $image);

            }
        }
        else
        {
            # return an error
            Router::redirect("/users/profile/error");  
        }

        # Redirect back to the profile page
        router::redirect('/users/profile'); 
    }  
        
        
} # end of the class
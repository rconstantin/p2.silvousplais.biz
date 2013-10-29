<?php
# Could move this function to common library but since it is users input specific will keep it
# here for now

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  return $data;
}

class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        # redirect to main page
        Router::redirect("/");
    }

    public function signup($firstName = NULL, $lastName = NULL, $email = NULL, $error = NULL) {
        # View Setup
        $this->template->content = View::instance('v_users_signup');
        $this->template->content->error = $error;
        $this->template->content->firstName = $firstName;
        $this->template->content->lastName = $lastName;
        $this->template->content->email = $email;
        $this->template->title = "Sign Up to " . APP_NAME;
        #load JS 
        $client_files_head = Array("/js/jquery-2.0.0.js", "/js/jstz-1.0.4.min.js");
        $this->template->client_files_head = Utils::load_client_files($client_files_head);
        # add Menu
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');

        # Render template
        echo $this->template;
    }

    public function p_signup() {
        # Validate that all required signup fields are not empty
        # for simplicity of logic and to use single error code - set
        # error to first missing field.
        $error = '';
        if (empty($_POST['first_name'])) 
        {
            $error = 'InvalidFirstName';
        }
        else {
            $_POST['first_name'] = test_input($_POST['first_name']);
        }
        if (empty($_POST['last_name'])) {
            $error = 'InvalidLastName';
        }
        else {
            $_POST['last_name'] = test_input($_POST['last_name']);
        }
        if (empty($_POST['email'])) {
            $error = 'InvalidEmail';
        }
        else {
            $_POST['email'] = test_input($_POST['email']);
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email']))
            {
                $error = "InvalidEmail";
                $_POST['email'] = '';
            }

        }
        if (empty($_POST['password'])) {
            $error = 'InvalidPassword';
        }
      
        # DB Validation that new user email is not already in use
        if (!$error) {
           # NEED NEW API to return count...  
           # $result = DB::instance(DB_NAME)->queryCount($q);
           # $q = "SELECT COUNT(*) FROM users WHERE email = '".$_POST['email']."'";

            $q = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
            $result = DB::instance(DB_NAME)->select_row($q);
          
            if (count($result) > 0) {
                $error = 'InvalidEmail';
            }
        }
        
        # Insert this user into the database - More error checking to follow
   
        if ($error != '') {
            $lastName = $_POST['last_name'];
            $firstName = $_POST['first_name'];
            $email = $_POST['email'];
       
            # send back to signup page
            Router::redirect("/users/signup/$firstName/$lastName/$email/$error");
        }
        else {
            # insert time (timestamp) of creation and last modify with user
            $_POST['created'] = Time::now();
            $_POST['modified'] = Time::now();

            #Encrypt Password
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            # create an encripted Token based on the email address and a random string
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email']).Utils::generate_random_string();
            # insert row into DB
            $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

            # redirect to anchor page
            # Router::redirect("/");
            # +Feature: redirect to profile page not requiring additional step to login
            $this->p_common_login($_POST['token']);
            Router::redirect("/users/profile");
        }
    }
    public function login($email = NULL, $error = NULL) {
        # Setup View
        $this->template->title = "Login";
        $this->template->content = View::instance('v_users_login');
        $this->template->content->email = $email;
        $this->template->content->error = $error;
        # add Menu
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');
        # Render template
        echo $this->template;
    }

    public function p_login()
    {
        
        $error = '';

        # Validate input parameter
        if (empty($_POST['email'])) {
            $error = 'InvalidEmail';
        }
        if (empty($_POST['password'])) {
            $error = 'InvalidPassword';
        }
        if ($error!= '')
        {
            if ($error != 'InvalidEmail') {
                $email = $_POST['email'];
            }
            else {
                $email = '';
            }
            # send back to login page, return email and error
            Router::redirect("/users/login/$email/$error");
        }
        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);
        $email = $_POST['email'];
        # If we didn't find a matching token in the database, it means login failed
        if(!$token) {
            $error = "PasswordMismatch";
            # Send them back to the login page
            Router::redirect("/users/login/$email/$error");
        }
        else {
            $this->p_common_login($token);
            # Since we found a token, login successfull redirect to menu page
            Router::redirect("/");
        }
    }
    # common login processing funtion used in the login and signup process
    public function p_common_login($token)
    {
        # set cookie based on token with 1 year expiry and entire domain access priviliges
        setcookie("token", $token, strtotime('+1 year'), '/');
        # Update the DB field that indicates the last login time
        $last_login = Time::now();
        $data['last_login'] = $last_login;
        $where_cond = "WHERE token = '".$token."'";
        DB::instance(DB_NAME)->Update_row('users',$data, $where_cond);
        # add Menu
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');
    }

    public function logout() {
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        $where_clause = "WHERE token = '".$this->user->token."'";
        DB::instance(DB_NAME)->update("users", $data, $where_clause);

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");
    }

    public function profile($error = NULL) 
    {
        # use the global user to determine whether logged in or not
        if (!$this->user) {
            # not logged in redirect to login page
            Router::redirect('/users/login');
        }
        # Create a View Instance and assign to template content
        $this->template->content = View::instance('v_users_profile');
        $this->template->content->error = $error;
      
        # Pass information to the view specific content
        $this->template->title = "Profile of ".$this->user->first_name;

        # add Menu
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');

        # Render View
        echo $this->template;
    }
    public function p_profile() {
        # first upload file to /uploads/avatars
        
        $avatarUrl = Upload::upload($_FILES,"/uploads/avatars/",
                                array("jpg", "jpeg", "gif", "png", "avi", "svg",
                                "JPG", "JPEG", "GIF", "PNG", "AVI", "SVG"), $this->user->user_id);
        if ($avatarUrl != 'Invalid file type.')
        {
            $this->user->avatarUrl = $avatarUrl;
  
            # update avatarUrl in the database
            $data = Array("avatarUrl"=>$this->user->avatarUrl);
            $where_clause = "WHERE user_id = '".$this->user->user_id."'";
            DB::instance(DB_NAME)->update("users", $data, $where_clause);
        }
        else {
            $error = 'InvalidFileType';
            Router::redirect("/users/profile/$error");
        }
        # Send them back to the main index.
        Router::redirect("/");

    }
} # end of the class
?>
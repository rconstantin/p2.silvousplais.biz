<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        # View Setup
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Sign Up to " . APP_NAME;

        # Render template
        echo $this->template;
    }
    public function p_signup() {
        # Insert this user into the database - More error checking to follow
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        # For now, just confirm that they signed up -
        # TBD error checking
        # TBD make a proper View for this or redirect to signin page
        echo 'Congratulation ' . $_POST['first_name'].'! You are signed up to ' . APP_NAME;
    }
    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) 
    {
        # Create a View Instance and assign to template content
        $this->template->content = View::instance('v_users_profile');

        # Pass information to the view specific content
        $this->template->content->user_name = $user_name;
        $this->template->content->time = Time::display(Time::now());
        $this->template->title = "Profile";
        # Render View
        echo $this->template;
    }
} # end of the class
?>
<?php
# class posts_controller will inherit from base_controller and
# will manage adding modifying posts and users relationships
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }

    public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

        # go back to main page

        Router::redirect("/");

    }
    
    public function index() {
        # Set up the View
        $this->template->content = View::instance('v_posts_index');
        $this->template->title = "Posts";

        $q = "SELECT posts.*, users.first_name, users.last_name
               FROM posts INNER JOIN users 
               ON posts.user_id=users.user_id";
         # Run this query
         $posts = DB::instance(DB_NAME)->select_rows($q);

         # Pass this data to the view
         $this->template->content->posts = $posts;

         # Render this view

         echo $this->template;      
    }
}

?>
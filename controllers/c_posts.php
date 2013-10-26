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
        $this->template->hide_menu = FALSE;
        $this->template->menu = View::instance('v_menu');


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

        # query that will only allow to display post of folks
        # being followed by logged in user

        $q = 'SELECT
                posts.content,
                posts.created,
                posts.user_id AS post_user_id,
                users_users.user_id AS follower_id,
                users.first_name,
                users.last_name,
                users.timezone,
                users.avatarUrl
              FROM posts
              INNER JOIN users_users 
                ON posts.user_id = users_users.user_id_followed
              INNER JOIN users
                ON posts.user_id = users.user_id
              WHERE users_users.user_id = '.$this->user->user_id;

         # Run this query
         $posts = DB::instance(DB_NAME)->select_rows($q);

         # Pass this data to the view
         $this->template->content->posts = $posts;

         # Render this view

         echo $this->template;      
    }
    public function users() {
        # Set up the View
        $this->template->content = View::instance("v_posts_users");
        $this->template->title = "Users";

        $q = "SELECT * FROM users";

        $users = DB::instance(DB_NAME)->select_rows($q);

        # Build query to get all the users from users_users followed by this user
        $q = "SELECT *
            FROM users_users
            WHERE users_users.user_id = ".$this->user->user_id;
        
        # use select_array APi with user_id_followed as index
        # to facilitate view display code
        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
        
        # Pass data to the view
        $this->template->content->users = $users;
        $this->template->content->connections = $connections;
        # Render this view

        echo $this->template;    

    }
    public function follow($user_id_followed) {

        # Prepare the data array to be inserted
        $data = Array (
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed);

        # insert array into users_users table
        DB::instance(DB_NAME)->insert('users_users', $data);

        # send back to users view
        Router::redirect("/posts/users");
    }
    public function unfollow($user_id_followed) {
        # Where clause for the delete
        $where_clause = 'WHERE user_id =' .$this->user->user_id.' AND user_id_followed ='.$user_id_followed;

        # delete from DB table
        DB::instance(DB_NAME)->delete('users_users', $where_clause);

        # send them back to /posts/users

        Router::redirect('/posts/users');
    }
}

?>
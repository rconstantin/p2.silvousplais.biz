<?php
class posts_controller extends base_controller {

  public function __construct() {
    parent::__construct();
    echo "posts_controller construct called<br><br>";
  } 

  public function index() {
    echo "This is the index page";
  }

  public function newPost() {
    echo "This is the create post page";
  }

  public function viewPosts($friend_name = NULL) {
    echo "This is the view posts page";
  }

  public function circleOfFriends() {
    echo "This is the circle of friends page";
  }

} # end of the class
?>

<ul id="nav">
    <!-- restrict menu for users who not are logged in -->
    <?php if(!$user): ?>
        <li><a href='/users/signup'>Sign up</a></li>
        <li><a href='/users/login'>Log in</a></li>
    <?php else: ?>   
        <li><a href='/'> Home </a></li> 
        <li><a href='posts/circleOfFriends'>Followers</a></li>
        <li><a href='/users/profile'>Profile</a></li>
        <li><a href='/posts/viewPosts'>Posts</a></li>
        <li><a href='/users/logout'>Logout</a></li>
    <?php endif; ?>    
</ul>

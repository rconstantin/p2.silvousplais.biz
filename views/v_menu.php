
<ul id="nav">
    <!-- restrict menu for users who not are logged in -->
    <?php if(!$user): ?>
        <li><a href='/users/signup'>Sign up</a></li>
        <li><a href='/users/login'>Log in</a></li>
    <?php else: ?>   
        <li><a href='/'> Home </a></li> 
        <li><a href='/users/profile'>Profile</a></li>
        <li><a href='/posts/users'>Following</a></li>
        <li><a href='/posts/followers'>Followers</a></li>
        <li><a href='/posts/add'>Add Post</a></li>
        <li><a href='/posts/index'>viewPosts</a></li>
        <li><a href='/users/logout'>Logout</a></li>
    <?php endif; ?>    
</ul>

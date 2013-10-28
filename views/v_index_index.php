<h1>Welcome to <?=APP_NAME?>
    <?php if($user) :?> 
        <?php echo ' , ' .$user->first_name .': enjoy le blog';?>
    <?php endif ?>
</h1>
<p>
    <img class="floatleft" src="/uploads/avatars/busytown2.jpg" alt="" width="200" height="150"><li><p1><?=APP_NAME?> is a micro blog where people can join to share messages with other members. First time visitors, need to signup. The email/password fields will be used to login in subsequent visits</p1></li>
    
    <li><p1>

    Once signed up/logged in, members can modify their profiles, manage their connections with other members (follow/unfollow), view a list of their followers, modify or delete their old posts and write new posts. <p1></li>
    <br> <br> 
</p>
<p1> +1 Feature: successful Signup will redirect to Profile Page, where the new member could update Avatar <p1> <br>
<p1> +1 Feature: upload URL Avatar in profile </p1> <br>
<p1> +1 Feature: Update/Delete Blog Messages </p1><br>


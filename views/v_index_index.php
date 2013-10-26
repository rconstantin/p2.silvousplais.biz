<h1>Welcome to <?=APP_NAME?>
    <?php if($user) :?> 
        <?php echo ' , ' .$user->first_name .': enjoy le blog';?>
    <?php endif ?>
</h1>
<p>
    <img class="floatleft" src="/uploads/avatars/busytown2.jpg" alt="" width="200" height="150"><?=APP_NAME?> is a micro blog where people can join in via the signup page and write messages to share with other members. Members can follow others and have access to their blogs. 
    Once signed up, members can modify their profiles, follow others, write new posts, modify or delete their old posts and view blogs of members they are following. 
    <br> <br> 
</p>
<p1> +1 Feature: upload URL Avatar in profile </p1> <br>
<p1> +1 Feature: Update/Delete Blog Messages </p1> 

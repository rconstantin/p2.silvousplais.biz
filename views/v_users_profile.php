   
<h1>This is <?=$user->first_name?> <?=$user->last_name?>'s  profile:</h1>

<p1> Email: <?= $user->email ?> <br /> <br /> </p1>
<p1> Member Since: <?php $mem = Time::Display($user->created,'',$user->timezone); echo $mem; ?> <br /> <br /> </p1>
<p1> Number of Followers: <?=$stats['followers']?> <br /> <br /> </p1>
<p1> Number of Members <?= $user->first_name ?> is following: <?=$stats['followings']?>  <br /> <br /> </p1>
<p1> Number of Active Posts by <?= $user->first_name ?>: <?=$stats['posts']?>  <br /> <br /> </p1>
<p> Upload/Change your Personal Avatar<p> 

<?php if ($user->avatarUrl) : ?>
    <img class="circular" src="/uploads/avatars/<?=$user->avatarUrl?>" 
                alt="" width="60" height="60">
<? endif; ?> 
<form method='POST' action='/users/p_profile' enctype="multipart/form-data">
    <span class="error"><?php if (isset($error)) {echo '* Invalid File: Please Enter a Valid file(.jpg, png, svg, etc) and Size less than ' .ini_get('upload_max_filesize');}?> </span>
    <br>
    <input type="file" name="file">
    <br> <br>                   
    <input type="submit" name="submit" 
           style="background-color: green; color: #ffffff;">
</form>           

<? foreach($followers as $follower): ?>
    <!-- Print this user's name -->
    <?=$follower['first_name']?> <?=$follower['last_name']?> <br>
    <?php if(isset($follower['avatarUrl'])): ?>
        <img class="circular" src="/uploads/avatars/<?=$follower['avatarUrl']?>" 
                alt="" width="80" height="80">
    <?php endif; ?>
    <p1> Follower Since: 
        <time datetime="<?=Time::display($follower['follower_since'],'Y-m-d G:i',$follower['timezone'])?>">
            <?=Time::display($follower['follower_since'],'',$follower['timezone'])?>
        </time>
    </p1>  
    <br> <br>
<? endforeach; ?>      
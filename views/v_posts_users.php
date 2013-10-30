<? foreach($users as $user): ?>
    <!-- Print this user's name -->
    <h4>
        <?=$user['first_name']?> <?=$user['last_name']?> <br>
        <?php if(isset($user['avatarUrl'])): ?>
            <img class="circular" src="/uploads/avatars/<?=$user['avatarUrl']?>" 
                alt="" width="80" height="80">
        <?php endif; ?> 
        <br>
        <? if(isset($connections[$user['user_id']])): ?>
            <a class="button" href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

            <!-- Otherwise, show the follow link -->
        <? else: ?>
            <a class="button" href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
        <? endif; ?>  
    
        <br> <br>
    </h4>    
<? endforeach; ?>   
 

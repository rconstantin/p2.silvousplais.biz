<? foreach($users as $user): ?>
    <!-- Print this user's name -->
    <?=$user['first_name']?> <?=$user['last_name']?>
    <? if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

        <!-- Otherwise, show the follow link -->
    <? else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <? endif; ?>  
    
    <br> <br>
<? endforeach; ?>      
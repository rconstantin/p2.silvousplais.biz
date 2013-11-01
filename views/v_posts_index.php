<!-- check if no posts are active for this user -->
<?php if(count($posts) == 0): ?>
    <h4> Sorry <?=$user->first_name?>, You have no active posts to view. </h4>
    <h4> You need to Add Posts and/or Follow other active Members. </h4>
<?php endif; ?>    
<!-- use this variable to display owner name and avatar only once at top of list -->
<?php $prev_posts_user_id = -1; ?>
<?php foreach($posts as $post): ?>

<article>
    <!-- print owner name and display avatar at top of posts by owner. 
         No need for Avatar if owner is same as logged in user -->         
    <?php if ($post['post_user_id'] != $prev_posts_user_id): ?>
        <?php if($post['post_user_id'] != $user->user_id): ?>
            <!-- Display Name and show Avatar for following member -->
            <h4><?=$post['first_name']?> <?=$post['last_name']?> posted:</h4> 
            <img class="floatcircright" src="/uploads/avatars/<?=$post['avatarUrl']?>" alt="" width="60" height="60">
        <?php else: ?>
            <h4> Your Active Posts: </h4>    
        <?php endif; ?>
        <?php $prev_posts_user_id = $post['post_user_id'] ?>
    <?php endif; ?>    

    <aside>
        <p>
            <!-- For those posts owned by this user id provide option to delete post-->
            <?php if ($post['post_user_id'] == $user->user_id): ?>
                <a class='floatright' href='/posts/delete/<?=$post['post_id']?>'>Delete Post</a>
                <a class='floatright' href='/posts/modify/<?=$post['post_id']?>'>Modify Post</a>
            <? endif; ?> 
            <?=$post['content']?>
        </p> 
        
        <p3>Created on: 
            <time datetime="<?=Time::display($post['created'],'Y-m-d G:i',$post['timezone'])?>">
                <?=Time::display($post['created'],'',$post['timezone'])?>
            </time>
        </p1>
        <?php if($post['created'] != $post['modified']): ?>
            <br>
            <p3>Last Modified on: 
                <time datetime="<?=Time::display($post['modified'],'Y-m-d G:i',$post['timezone'])?>">
                    <?=Time::display($post['modified'],'',$post['timezone'])?>
                </time>
            </p1>
        <?php endif; ?>    
    </aside>        
</article>
<?php endforeach; ?>

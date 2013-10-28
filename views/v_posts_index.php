<!-- use this variable to display owner name and avatar only once at top of list -->
<?php $prev_posts_user_id = -1; ?>
<?php foreach($posts as $post): ?>

<article>
    <!-- print owner name and display avatar at top of posts by owner. 
         No need for Avatar if owner is same as logged in user -->
    <?php if ($post['post_user_id'] != $prev_posts_user_id): ?>
        <h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3> <br>
        <?php if($post['avatarUrl'] AND $post['post_user_id'] != $user->user_id): ?>
            <img class="floatcircright" src="/uploads/avatars/<?=$post['avatarUrl']?>" alt="" width="100" height="100">
        <?php endif; ?>
        <?php $prev_posts_user_id = $post['post_user_id'] ?>
    <?php endif; ?>    

    <aside>
        <p1>
            <?=$post['content']?>
            <!-- For those posts owned by this user id provide option to delete post-->
            <?php if ($post['post_user_id'] == $user->user_id): ?>
                <a class='floatright' href='/posts/delete/<?=$post['post_id']?>'>Delete Post</a>
            <? endif; ?> 
        </p1> 
        <br>
        <p1> Post Created on: 
            <time datetime="<?=Time::display($post['created'],'Y-m-d G:i',$post['timezone'])?>">
                <?=Time::display($post['created'],'',$post['timezone'])?>
            </time>
        </p1>
    </aside>        
</article>

<?php endforeach; ?>
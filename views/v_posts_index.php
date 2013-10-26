<?php foreach($posts as $post): ?>

<article>

    <h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3> 
    
    <?php if($post['avatarUrl']): ?>
        <img class="circular" src="/uploads/avatars/<?=$post['avatarUrl']?>" alt="" width="100" height="100">
    <?php endif; ?>
    <br>
    <p1><?=$post['content']?></p1> <br>

    <p1> Post Created on: <time datetime="<?=Time::display($post['created'],'Y-m-d G:i',$post['timezone'])?>">
        <?=Time::display($post['created'],'',$post['timezone'])?></p1>
    </time>
</article>

<?php endforeach; ?>
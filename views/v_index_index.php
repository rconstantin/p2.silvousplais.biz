<h1>Welcome to <?=APP_NAME?>
    <?php if($user) :?> 
        <?php echo ' , ' .$user->first_name .': enjoy le blog';?>
    <?php endif ?>
</h1>
<img src="/uploads/avatars/busytown2.jpg" alt="" width="200" height="200">
<?php if(isset($user_name)): ?>
    <h1>This is the profile for <?=$user_name?></h1>
    <p> Time is <?=$time?> </p>
<?php else: ?>
    <h1>No user specified</h1>
<? endif; ?>

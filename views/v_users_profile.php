<h1>This is the profile of <?=$user->first_name?></h1>

<p1> First Name: <?= $user->first_name ?> <br /> <br /> </p1>
<p1> Last Name: <?= $user->last_name ?> <br /> <br /> </p1>
<p1> Email: <?= $user->email ?> <br /> <br /> </p1>
<p1> Member Since: <?php $mem = Time::Display($user->created); echo $mem; ?> <br /> <br /> </p1>
<p1> Number of Followers: TBD <br /> <br /> </p1>
<p1> Number of Members <?= $user->first_name ?> is following: TBD <br /> <br /> </p1>
<p1> Number of Active Posts by <?= $user->first_name ?>: TBD <br /> <br /> </p1>

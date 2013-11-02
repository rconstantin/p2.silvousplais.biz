<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) echo $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
    <!-- Common JS/CSS -->
    <!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>					
    <!-- Controller Specific JS/CSS -->
    <?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
    <div id="wrapper" >
        <header>
            <h1> 
                <?php if((!$user) OR (!$user->avatarUrl)): ?>
                    <img class="floatright" src="/uploads/avatars/busytown.jpg" alt="" width="100" height="100">
                <?php else : ?>
                     <img class="floatcircright" src="/uploads/avatars/<?=$user->avatarUrl?>" alt="" width="80" height="80">
                <?php endif; ?>   
                A peek into the life of the mysterious BusyTown enhabitants 
            </h1>
            <?php if (!$user): ?>
                <h2 id="tagline" > Come Join Huckle, Lowly and Sally to name a few </h2>
            <?php else: ?>
                <h3> Welcome <?=$user->first_name?>,
                    <a href='/users/profile'>[Profile]</a>
                    <a href='/users/logout'>[Logout]</a>
                </h3>
            <?php endif; ?>       
        </header>
        <section>
            <?php if(isset($hide_menu) AND !$hide_menu): ?>
                <div id='menu'>
                    <?=$menu;?>
                </div>
            <?php endif; ?>
            <?php if(isset($content)) echo $content; ?>
            <br> <br>
            <?php if(isset($client_files_body)) echo $client_files_body; ?>
        </section>
    </div>       
</body>
</html>
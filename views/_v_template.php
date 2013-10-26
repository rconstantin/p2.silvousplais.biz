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
                     <img class="floatcircright" src="/uploads/avatars/<?=$user->avatarUrl?>" alt="" width="100" height="100">
                <?php endif; ?>   
                A day in the life of the amazing BusyTown enhabitants 
            </h1>
            <?php if (!$user): ?>
                <h2 id="tagline" > Come Join Huckle, Lowly and Sally to name a few </h2>
            <?php else: ?>
                <h2 id="tagline" > <?=$user->first_name?> is logged in </h2>
             <?php endif; ?>       
        </header>
        <aside>
            <?php if(isset($hide_menu) AND !$hide_menu): ?>
                <div id='menu'>
                    <?=$menu;?>
                </div>
            <?php endif; ?>
            <?php if(isset($content)) echo $content; ?>
            <br> <br>
            <?php if(isset($client_files_body)) echo $client_files_body; ?>
        </aside>
    </div>       
</body>
</html>
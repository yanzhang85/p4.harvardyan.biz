<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title . " | "; ?>Netchat</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<link rel="stylesheet" href="/css/style.css" type="text/css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<?php if($user): ?>
				<li><a href='/users/profile'>Update profile</a></li>
			    <li><a href='/posts/add'>Add posts</a></li>
			    <li><a href='/posts/'>View posts</a></li>
			    <li><a href='/posts/users'>Follow others</a></li>
			    <li><a href='/chat/room'>Chat</a></li>
			    <li><a href='/game'>Game</a></li>
			    <li><a href='/users/logout'>Log out</a></li>
			<?php else: ?>
			    <li><a href='/users/signup'>Sign up</a></li>
			    <li><a href='/users/login'>Log in</a></li>
			<?php endif; ?>
		</ul>
	</nav>
<h2> Welcome to Netchat! </h2>


	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>


	
</body>
</html>
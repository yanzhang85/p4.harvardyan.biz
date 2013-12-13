<section class="content posts">
	<h3> View Posts </h3>
	<?php foreach($posts as $post): ?>

	<article>
		<!-- display this user's profile image -->
	    <img class="profile-pic" src="/uploads/avatars/<?=$post['image']?>" alt="<?=$post['first_name']?> <?=$post['last_name']?>">
	    <!-- Print this user's name -->
	    <div class="name"><?=$post['first_name']?> <?=$post['last_name']?> posted:</div>

	    <p><?=$post['content']?></p>

	    <h4 class="time"><time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	        <?=Time::display($post['created'])?>
	    </time>
		</h4>

	</article>

	<?php endforeach; ?>
</section>
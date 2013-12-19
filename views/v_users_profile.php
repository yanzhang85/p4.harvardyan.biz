<section class="content profile"> 
	<h3> Update Profile</h3>
	<h1> Hello, <?=$user->first_name?>! </h1>
	<p> You have been with us since <?= date('F j, Y', $user->created) ?>.
		Thank you for your support!
	</p>
	<h4> Your current image</h4>
	<!-- upload image -->
	<form role="form" method='POST' enctype="multipart/form-data" action='/users/profile_update/'>
		<img class="profile-pic" src="/uploads/avatars/<?= $user->image ?>" alt="<?=$user->first_name . ' ' . $user->last_name ?>">                 
		<div>
			<label for="avata">Do you want to make some change?</label> 
			<input type="file" name="avata" id="avata"> 
			<?php if(isset($error)): ?>	           
				<div class="messge error">Upload failed.<br> 
					Image file must be a jpg, gif, or png.
				</div>	        
			<?php endif; ?>
			<button type="submit" class="button">Update Image</button>
		</div>
	</form>

	<!-- if there is an error in uploading the image -->
	     
</section>
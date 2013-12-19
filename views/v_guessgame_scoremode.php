<section class="content guess">

	<h3>Guess my number (score mode)</h3>

	<div id="features">
		<h4> Features: </h4>
		<ul>
			<li>Score mode -- A possible highest score: "100"</li>
			<li>Show how many digits and positions the guess matches the answer each time</li>
			<li>Five points deducted for every additional try after first five guesses</li>
			<li>Two additional hints available</li>
		</ul>
	</div>

	<div id='results'></div>
	<div id="take_guess">
		Pick a number <br>between 10000 and 99999: <br>
		<input type='text' name='guess' onkeypress="if (isNaN(String.fromCharCode(event.keyCode) )) return false;" maxlength ="8"/>
		<button id='guess_score'>Guess</button>
		<div id='error'></div>
		<p> Scratchpad:<br>
			<textarea rows="3" cols="20"></textarea><br>
		</p>
		
	</div>


	<div id='history'>
		Your past guesses: <br>
		<div id='guesses'></div>
	</div>

	<p id='hint'>Hints (available for one time only)</p> 
	<div class='hint'>
		<div class = 'hint1'> Hint 1 (10 points deducted): <br>How many digits with the same number? <br>
			<button id='hint1'> Submit </button><br>
			<div id='result_hint1'></div><br>
		</div>

		<div class = 'hint2'> Hint 2 (15 points deducted): <br> Which digit do you want to know?
			<select name='digit'> 
				<option value='0'>First</option>
				<option value='1'>Second</option>
				<option value='2'>Third</option>
				<option value='3'>Fourth</option>
				<option value='4'>Fifth</option>
			</select> <br>
			<button id='hint2'> Submit </button><br>
			<div id='result_hint2'></div>
		</div>
	</div>
	
	<div>
		Your current score
		<span class='score'></span>
	</div>
	<!-- show the message of you breaking the record -->
	<div id="record" >
	    <p>You just broke you own record. Do you want to share it with your friends?</p>
	    <a href="#post" id="post_record">YES</a><a href="#post" id="unpost_record">NO</a>
	</div>
	<a name="post"></a> 
	<!-- show the post area -->
	<div class="hidden" id="hidden">
		<form class="new-post" method='POST' action='/posts/p_add'>
			<textarea name='content' id='guessgame_content' rows="5" cols="100"> </textarea>
	    	<br>
	    	<div class="button"><input type='submit' value='Add post'></div>
	    	
		</form> 
		<div id="post_results"></div>
	</div>

	<!-- pass the record to JS -->
	<input type="hidden" id="highest_score" value="<?=$game_record[0]['guess_score']?>" >
</section>
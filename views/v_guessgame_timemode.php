<section class="content guess">

	<h3>Guess my number (time mode)</h3>

	<div id="features">
		<h4> Features: </h4>
		<ul>
			<li>Time mode -- Can you guess the number in 5 minutes?</li>
			<li>Show how many digits and positions the guess matches the answer each time</li>
			<li>Unlimited times of guesses but no hints available</li>
			<li>Time starts when you hit the "Start Game" button</li>
		</ul>
	</div>

	<button id='ready'>Start Game</button>
	<div id='results'></div>
	<div id="timemessage"></div>
	<div id="take_guess">
		Pick a number <br>between 10000 and 99999: <br>
		<input type='text' name='guess' onkeypress="if (isNaN(String.fromCharCode(event.keyCode) )) return false;" maxlength ="8"/>
		<button id='guess_time'>Guess</button>
		<div id='error'></div>
		<p> Scratchpad:<br>
			<textarea rows="3" cols="20"></textarea><br>
		</p>
		
	</div>


	<div id='history'>
		Your past guesses: <br>
		<div id='guesses'></div>
	</div>

	<div> Remaining Seconds <br>
		  <span id="countdown">300</span> 
	</div>

	<div id="record" style="float:right;display:none;border:1px dotted gray;padding:.3em;background-color:white;width:200px;height:100px;">
	    <p>You just broke you own record. Do you want to share it with your friends?</p>
	    <a href="#post" id="post_record">YES</a>
	    <a href="#post" id="unpost_record">NO</a>
	</div>
	<a name="post"></a> 
	<div class="hidden" id="hidden">
		<form class="new-post" method='POST' action='/posts/p_add'>
			<textarea name='content' id='guessgame_content' rows="5" cols="100"> </textarea>
	    	<br>
	    	<div class="button"><input type='submit' value='Add post'></div>

		</form> 
		<div id="post_results"></div>
	</div>

	<input type="hidden" id="shortest_time" value="<?=$game_record[0]['guess_time']?>" >
</section>
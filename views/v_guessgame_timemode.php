<h1>Guess my number</h1>

<div id="change_version">Still need <a href="/practice_version.php">practice</a>? </div>
<h2> (Match Version) </h2>


<div id="features">
	<h4> Features: </h4>
	<ul>
		<li>Score mode -- A possible highest score: "100"</li>
		<li>Show how many digits and positions the guess matches the answer</li>
		<li>Five points deducted for every additional try after first five guesses</li>
		<li>Two additional hints available</li>
	</ul>
</div>

<center><button id='ready'>Start Game</button></center>
<div id='results'></div>
<div id="take_guess">
	Pick a number <br>between 10000 and 99999: <br>
	<input type='text' name='guess' onkeypress="if (isNaN(String.fromCharCode(event.keyCode) )) return false;" maxlength ="8"/>
	<button id='guess_time'>Guess</button>
	<div id='error'></div>
	<p> Scratchpad:<br>
		<textarea></textarea><br>
	</p>
	
</div>


<div id='history'>
	Your past guesses: <br>
	<div id='guesses'></div>
</div>

<div> Remaining Seconds <br>
	  <span id="countdown">300</span> 
</div>

<div id="timemessage"></div>

<div id="record" style="float:right;display:none;border:1px dotted gray;padding:.3em;background-color:white;width:200px;height:100px;">
    <p>You just broke you own record. Do you want to share it with your friends?</p>
    <a href="#post" id="post_record">YES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#post" id="unpost_record">NO</a>
</div>
<a name="post"></a> 
<div class="hidden" id="hidden">
	<form class="new-post" method='POST' action='/posts/p_add'>
		<textarea name='content' id='guessgame_content'> </textarea>
    	<br>
    	<div class="button"><input type='submit' value='Add post'></div>

	</form> 
</div>

<input type="hidden" id="shortest_time" value="<?=$game_record[0]['guess_time']?>" >
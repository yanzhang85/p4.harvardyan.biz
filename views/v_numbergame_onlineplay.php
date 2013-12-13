<br><br><br><br>

<section class="content follow">



	To test, have a friend visit this page, or open the page up in a separate browser to play against yourself.
	<br><br>
	
	<button id='roll'>Roll</button><br><br>
	<input type="hidden" id="opponent_player_id" value="<?=$opponent_player_id?>" >
	<input type="hidden" id="this_player_id" value="<?=$this_player_id?>" >

	You:<br>
	<div class='dice' id='you'></div><br>

	Opponent<?=$opponent_player_id?> :
	<div class='dice' id='opponent'></div><br>
	
	<div id='output'></div>
</section>

	
for(var i=0;i<=9;i++) {
	
	
	// Put each number in a span so we can color it later
	$('#number').append('<span class="number" id="'+i+'">'+i+'</span>');
	if ((i+1)%5 ==0){
		$('#number').append('<br>');
	}
}

// get rabdom number array
var random_number_array = new Array;
    random_number_array[0] = Math.floor((Math.random()*9)+1);
	for (var j=1;j<5;j++){
		random_number_array[j] = Math.floor((Math.random()*9)+0);
	}

//console.log("Picked number:" + guess_array);//
console.log("Computer's number:" + random_number_array);

// get score for the match version
var score=100;
$('.score').html(score);

// define variabls on the page
var digit_match_count = position_match_count = 0;

// define trial times for match version
var trial_times=0;

$("#guess_time").attr("disabled", "disabled");

// key "enter" works in the number input
$('input[name=guess]').keyup(function(e){
	// key "enter" works in the guess
	if(e.keyCode == 13){
		$(this).trigger("enterkey");
	}
	// present error message if input more than 5 digits
	var value = $(this).val();
	var how_many_digits = value.length;
	if (how_many_digits >5) {
		$('#error').html('5 digits only');
	}
	// error message disappears if input go back to less than 5 digits
	else {
		$('#error').html('');
	}
});


// key "enter" trigger the submit
$('input[name=guess]').bind("enterkey",function(eve){
	$('#guess_score').trigger("click");
	$('#guess_practice').trigger("click");
});

	
// Play_match version! 
$('#guess_score').click(function() {
	
	check_answer();
	// count trail times
	trial_times++;
	// 5 ponites deducted for everytime after 5 guesses
	if (trial_times>5){
		score -=5;
		$('.score').html(score);
	}		
	// If their match count equals the the length of the computer's word, Winner! 
	if(digit_match_count == 5) {
		if (score>=80){
			$("#results").html('Smart guy! What about playing <a href="/guessgame/scoremode">one more time</a>?');
		}
		else if (score>=60 && score<80){
			$("#results").html('You got it! How about getting a higher score on <a href="/guessgame/scoremode">another try</a>?'); 
		}
		else {
			$("#results").html('You got it! But the score could be better.. <a href="/guessgame/scoremode">Try it again</a>!');
		};
		// disable the buttons
		$("#guess_score").attr("disabled", "disabled");
		$("#hint1").attr("disabled", "disabled");
		$("#hint2").attr("disabled", "disabled");
		var highest_score=$('#highest_score').val();
		console.log(highest_score);
		if (score > highest_score) {
			var add=window.open('/guessgame/scoreadd/'+score);
			add.close();
			$('#record').show();
			$('#post_record').click(function(){
				$('#record').hide();
				$('#hidden').show();
				$('#guessgame_content').html('Awesome! I have a new game record. I got ' + score + ' in the number guess game.');
			});
			$('#unpost_record').click(function(){
				$('#record').hide();
			});
		}
	}
	digit_match_count= position_match_count=0;
	$('input[name=guess]').val('');
});	

// Play_practice version! 
$('#guess_practice').click(function() {
	
	// What guess did the player make?
	var guess = $('input[name=guess]').val();
	
	// Break their word into an array; each letter is an element in the array
	guess_array = guess.split('');
	// Check whether the guess is 5-digit or not
	if (!(guess_array.length ==5)){
		alert('5-digit numbers, please!');
		return 1;
	}
	// check whether the guess is a valid 5-digit
	if (guess_array[0]==0) {
		alert('The first digit cannot be 0!');
		return 1;
	}
	
	// define variables
	var position_match_count = 0;
	var result_array = new Array;
	
	// Loop through the numbers in their guess
	for(i in guess_array) {	
		// Check whether your guess matches every position in the answer		
		if (guess_array[i]==random_number_array[i]){
			result_array[i]='T';
			position_match_count++;
		}
		else { result_array[i]='F';
		}			
	}
	
	// If position_match_count is 0 
	// grey out the numbers that are not in the answer
	if(position_match_count == 0) {
		for(i in guess_array) {
			var number = guess_array[i];
			for (j=0;j<5;j++){
				if (number == random_number_array[j]){
					var number_included =1;
				}
			}
			if (!number_included){
				$('#' + number).css('color','#eee');
			}
			number_included =0;
		}
	}
	
	
	// Print out their guess and whether each position is correct
	
	for(i=4;i>=0;i--){
		$('#guesses').prepend(' ' + result_array[i]);
	}
	$('#guesses').prepend(guess + ' -> ');
	$('#guesses').prepend('<br>');
	
	// If their match count equals the the length of the computer's word, Winner! 
	if(position_match_count == 5) {
		$("#results").html('Correct! You are ready for a match with <a href="/guessgame/scoremode">score mode</a> or <a href="/guessgame/timemode">time mode</a>!');
		// disable the button
		$("#guess_practice").attr("disabled", "disabled");
	}
	$('input[name=guess]').val('');
});	

//hint1 		
$('#hint1').one('click',function(){
	var same_digit_times = same_i_times = 0;
	// Check whether there are digits with the same number
	for (i=0;i<4;i++){
		for (j=i;j<5;j++){
			if (random_number_array[i] == random_number_array[j]) {
			same_i_times++;
			}
		}
		// Replace same_digit_times with same_i_times if same_i_times is bigger than same_digit_times
		if (same_i_times > same_digit_times){
			same_digit_times = same_i_times
		}
		same_i_times = 0;
	}
	// if no digit with the same number
	if (same_digit_times == 1){
	$("#result_hint1").html('There is no digit with the same number!');	
	}
	// show how many digits with the same number
	else { $("#result_hint1").html('There are ' +  same_digit_times  + ' digits with the same number.');
	}
	// change the button color
	$('#hint1').css('color','#bbaaaa');
	// 10 points deducted
	score -=10;
	$('.score').html(score);
});


//hint2
$('#hint2').one('click',function(){
	var digit = $('select[name=digit]').val();
	// show the digit at the desired position
	$("#result_hint2").html('The number is ' + random_number_array[digit] + '.');
	// change the button color
	$('#hint2').css('color','#bbaaaa');
	// 15 points deducted
	score -=15;
	$('.score').html(score);
});

var time_left = 300;
var cinterval;

function time_dec(){
  time_left--;
  $('#countdown').html(time_left);
  if (time_left <60){
  	$('#countdown').css('color','red');
  }
  if(time_left == 0){
  	$("#timemessage").html('Sorry, the time is out. What about playing <a href="/guessgame/timemode">one more time</a>?');
  	$("#guess_score").attr("disabled", "disabled");
    clearInterval(cinterval);
  }
}

$('#ready').one('click',function(){
	cinterval = setInterval('time_dec()', 1000);
	$("#ready").attr("disabled", "disabled");
	$("#guess_time").removeAttr("disabled");
	$('input[name=guess]').bind("enterkey",function(eve){
		$('#guess_time').trigger("click");
	});
})

// Play_match version! 
$('#guess_time').click(function() {
	
	check_answer();
	
	if(digit_match_count == 5){
		clearInterval(cinterval);
		$('#results').html('You are awesome! Wannna play it again?');
		$("#guess_time").attr("disabled", "disabled");
		var shortest_time=$('#shortest_time').val();
		console.log(shortest_time);
		if (time_left > shortest_time) {
			var time= 300 - time_left;
			var add=window.open('/guessgame/timeadd/'+time_left);
			add.close();
			$('#record').show();
			$('#post_record').click(function(){
				$('#record').hide();
				$('#hidden').show();
				$('#guessgame_content').html('Awesome! I have a new game record. It only takes ' + time +' seconds to figure out the 5-digit number.');
			});
			$('#unpost_record').click(function(){
				$('#record').hide();
			});
		}	
	}
	//reset variables
	digit_match_count= position_match_count=0;
	$('input[name=guess]').val('');
});

function check_answer(){

	// What guess did the player make?
	var guess = $('input[name=guess]').val();
	
	// Break their word into an array; each letter is an element in the array
	guess_array = guess.split('');

	// Check whether the guess is 5-digit or not
	if (!(guess_array.length ==5)){
		alert('5-digit numbers, please!');
		return 1;
	}
	// check whether the guess is a valid 5-digit
	if (guess_array[0]==0) {
		alert('The first digit cannot be 0!');
		return 1;
	}
	
	// define variables
	
			
	// Loop through the numbers in their guess
	for(i in random_number_array) {
		// Check whether your guess matches every position in the answer
		for(j=0;j<5;j++){
			if (random_number_array[i]==guess_array[j]){
				if (i==j) {
					position_match_count++;
				}
				var i_match = 1;	
			}
			
		}
		// Check whether the digits in your guess are in the answer
		if (i_match){
			digit_match_count++;
			i_match=0;
		}
	}
	// Print out their guess and how many digits and positions matched
	$('#guesses').prepend(guess + ' : ' + digit_match_count + ' digits match' + '; ' + position_match_count + ' positions match<br>');
}


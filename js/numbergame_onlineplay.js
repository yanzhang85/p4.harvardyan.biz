var opponent_player_id = $('#opponent_player_id').val();
var this_player_id = $('#this_player_id').val();
var opponent       = $('#opponent');
var you            = $('#you');
var output         = $('#output');
console.log(opponent_player_id);
console.log(this_player_id);

        
// Sandbox credentials for pubnub.com; Sign-up for a free sandbox account to get your own credentials
var pubnub = PUBNUB.init({
    publish_key: 'pub-c-d15ab5ae-2120-4fb0-922f-17403d2fd70a',
    subscribe_key: 'sub-c-c529db60-5fae-11e3-a4ba-02ee2ddab7fe'
});


/*-------------------------------------------------------------------------------------------------
Subscribe to the channel
This is triggered after every turn, since the turn sends a message
-------------------------------------------------------------------------------------------------*/
pubnub.subscribe({
    channel: 'game',
    message: function(message){
    
        // Turn the string of JSON into an array
        var results   = $.parseJSON(message);
                        
        // Pull the player_id and roll out of the array
        var player_id = results['player_id'];
        var roll      = results['roll'];                
        
        // Play!
        play(player_id,roll);
    },
    
});


/*-------------------------------------------------------------------------------------------------
You take a turn
-------------------------------------------------------------------------------------------------*/
$('#roll').click(function() {
    
    // What did you roll?
    var random_number = Math.floor((Math.random()*5)+1);
                
    // Output
    output.html('Waiting for an opponent to roll...<br>');
    you.html(random_number);

    // Data of player_id and roll
    data = { 
        'player_id' : this_player_id, 
        'roll' : random_number 
    }
    
    // Convert data to JSON string
    var message = JSON.stringify(data);
    
    // Publish 
    pubnub.publish({
        channel: 'game',        
        message: message,
    });
    
    // Get rid of button so you can't roll again
    $('button').hide();
        
});


/*-------------------------------------------------------------------------------------------------
Called after someone rolls. Responsible for figuring out where we are in the game.
-------------------------------------------------------------------------------------------------*/ 
function play(player_id, roll) {
        
    // Roll was by opponent, not you
    if(player_id == opponent_player_id) {
            
        // Output
        opponent.html(roll);
        
        // If your opponent has gone, but you have not
        if(opponent.html() != '' && you.html() == '') {
            output.html('An opponent is waiting for you to roll...<br>');   
        }
    }
    
    // End of game = both you and opponent have gone - see who won
    if(opponent.html() != '' && you.html() != '') {
        
        // Clear the output
        output.html('');    
            
        // Your opponents roll was higher than yours, you lost
        if(opponent.html() == you.html()) {
            output.append('A tie!<br>');    
        }
        else if(opponent.html() > you.html()) {
            output.append('You lost :(<br>');   
        }
        // Your roll was higher than your opponents, you win
        else {
            output.append('You won! :)<br>');   
        }
        
        output.append('Starting a new game in 3 seconds...<br>');   
        
        // Let them see the results for 3 seconds, then just refresh this page to start a new game
        setTimeout(function(){
            location.reload();
        },3000);
    }
    
    
}
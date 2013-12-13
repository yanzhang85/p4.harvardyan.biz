function show_popup(id) {
    if (document.getElementById){
        obj = document.getElementById(id);
        if (obj.style.display == "none") {
            obj.style.display = "";
        }
    }
}

function hide_popup(id){
    if (document.getElementById){
        obj = document.getElementById(id);
        if (obj.style.display == ""){
            obj.style.display = "none";
        }
    }
}

var this_player_id = $('#this_player_id').val();
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
        channel: 'invitation',
        message: function(message){
        
            // Turn the string of JSON into an array
            var results   = $.parseJSON(message);
                            
            // Pull the player_id and roll out of the array
            var invitor_player_id = results['invitor_player_id'];
            var invited_player_id = results['invited_player_id'];
                          
            
            // Invite!
            Invite(invitor_player_id,invited_player_id);
        },
        
    });

    pubnub.subscribe({
        channel: 'invitation_accepted',
        message: function(message){
        
            // Turn the string of JSON into an array
            var results   = $.parseJSON(message);
                            
            // Pull the player_id and roll out of the array
            var invitor_player_id = results['invitor_player_id'];
            var invited_player_id = results['invited_player_id'];
                          
            
            // Invite!
            Invite_accepted(invitor_player_id,invited_player_id);
        },
        
    });


$('#invitation').click(function() {
    var invited_player_id = $('#invitation').val();
    
   
    console.log(invited_player_id);
        


    // Data of player_id and roll
    data = { 
        'invitor_player_id':this_player_id,
        'invited_player_id' :invited_player_id
    }
    
    // Convert data to JSON string
    var message = JSON.stringify(data);
    
    // Publish 
    pubnub.publish({
        channel: 'invitation',        
        message: message,
    });
})
    /*-------------------------------------------------------------------------------------------------
    You take a turn
    -------------------------------------------------------------------------------------------------*/
           
                            
        // Output
       // output.html('Waiting for an opponent to roll...<br>');
       // you.html(random_number);

        
        
        // Get rid of button so you can't roll again
       


    /*-------------------------------------------------------------------------------------------------
    Called after someone rolls. Responsible for figuring out where we are in the game.
    -------------------------------------------------------------------------------------------------*/ 
function Invite(invitor_player_id,invited_player_id) {
        
    // Roll was by opponent, not you
    if(this_player_id == invited_player_id) {
       alert('A player is inviting you for a match.');

        show_popup(invitor_player_id);
      /*        
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
    */
    
    
    }
}


function Lab(obj) {
    var name = obj.name;
    console.log(name);
     // Data of player_id and roll
    data = { 
        'invitor_player_id':name,
        'invited_player_id' :this_player_id
    }
    
    // Convert data to JSON string
    var message = JSON.stringify(data);
    
    // Publish 
    pubnub.publish({
        channel: 'invitation_accepted',        
        message: message,
    });
}


function Invite_accepted(invitor_player_id,invited_player_id) {
        
    // Roll was by opponent, not you
    if(this_player_id == invitor_player_id) {
        var url= '/numbergame/onlineplay/'+invited_player_id;
       window.location.href= url;
    }
}
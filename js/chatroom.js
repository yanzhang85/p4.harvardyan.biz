
var this_user_name = $('#this_user_name').val();
console.log(this_user_name);

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
        channel: 'chat',
        message: function(message){
        
            // Turn the string of JSON into an array
            var results   = $.parseJSON(message);
                            
            // Pull the player_id and roll out of the array
            var this_user_name = results['this_user_name'];
            var chat_text = results['chat_text'];

            // Invite!
            Chat(this_user_name,chat_text);
        },
        
    });
$('input[name=chat]').keyup(function(e){
    // key "enter" works in the guess
    if(e.keyCode == 13){
        $(this).trigger("enterkey");
    }  
});


// key "enter" trigger the submit
$('input[name=chat]').bind("enterkey",function(eve){
    $('#chat_submit').trigger("click");
});

$('#chat_submit').click(function(){
    var chat_text = $('#chat').val();
    console.log(chat_text);
    

    if (chat_text.length == 0) {
        alert ('Do you have anything to say?');
        return 1;
    }
    

   data = { 
        'this_user_name':this_user_name,
        'chat_text' :chat_text
    }
    var message = JSON.stringify(data);
    
    // Publish 
    pubnub.publish({
        channel: 'chat',        
        message: message,
    });

    $('#chat').val('');
})
    /*-------------------------------------------------------------------------------------------------
    Called after someone rolls. Responsible for figuring out where we are in the game.
    -------------------------------------------------------------------------------------------------*/ 
function Chat(this_user_name,chat_text) {
    
    $('#chat_history').prepend(this_user_name + ': ' + chat_text);
    $('#chat_history').prepend('\n');    
}



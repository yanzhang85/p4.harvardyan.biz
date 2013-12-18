var a = $('#refresh-button').val;
console.log(a);

$('#refresh-button').click(function() {

    $.ajax({
        type: 'POST',
        url: '/game/p_gamerecord',
        success: function(response) { 

            // For debugging purposes
            console.log(response);

            // Example response: {"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}

            // Parse the JSON results into an array
            var data = $.parseJSON(response);

            // Inject the data into the page
            if (data['you_score_time']==0) {
                $('#you_score').html('You have not played the game yet. What about <a href="/guessgame/scoremode">playing it </a>right now?');
            } else {
                $('#you_score').html(data['you_score']);
            }
            if (data['you_time_time']==0) {
                $('#you_time').html('You have not played the game yet. What about <a href="/guessgame/timemode">playing it </a>right now?');
            } else {
                var you_time= 300- data['you_time'];
                $('#you_time').html(you_time);
            }
            $('#all_score').html(data['all_score']);
            var all_time= 300- data['all_time'];
            $('#all_time').html(all_time);

            if (data['you_score']==data['all_score']  || data['you_time'] == data['all_time']) {
                $('#message').html('You are a beast. You set the record in Netchat!');
            }

        },
    });
});
// Set up the options for ajax
var options = { 
    type: 'POST',
    url: '/posts/p_add/',
    beforeSubmit: function() {
        $('#post_results').html("Adding...");
    },
    success: function(response) {   
        $('#post_results').html(response);
    } 
}; 

// Using the above options, ajax'ify the form
$('form').ajaxForm(options);
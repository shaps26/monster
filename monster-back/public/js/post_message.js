$(document).ready(function(){
    $('#post_message').click(function(){
        var message = $('#message_body').val();
        var expeditor = $('#message_expeditor').val();
        $.ajax({
            type: 'POST',
            url: "/messages/new",
            data: {
                "message": message,
                "expeditor": expeditor
            }
        });
    });
});
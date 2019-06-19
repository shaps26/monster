$(document).ready(function(){
    $('#post_message').click(function(){
        var message = $('#message_body').val();
        $('#message_body').val('');
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
    $('.input_msg_write').submit(function(event){
        event.preventDefault();
        var message = $('#message_body').val();
        $('#message_body').val('');
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
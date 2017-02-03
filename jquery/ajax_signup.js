$(document).ready(function () {

    $('#nick').keyup(function () {
        nick = $(this).val();
        //alert(nick);
        $.ajax({
            type: "POST",
            data: {nickname: nick},
            url: "checkuser.php",
            success: function (msg) {
                //alert(msg);
                $('#ok').css('display', 'inline-block');
                if (msg == 0) {
                    $('#ok').html("Nome utente libero");
                    $('#ok').css('color', '#56e12b');
                } else {
                    $('#ok').html("Nome utente già utilizzato");
                    $('#ok').css({
                        'color': 'red',
                    });
                }
            },
            error: function () {
                alert('Error occured');
            }
        });
    });
});


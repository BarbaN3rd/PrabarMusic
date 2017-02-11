$(document).ready(function () {

    $('#changeInfo').click(function () {
        $('.modal-changeInfo').css('display', 'block');
        $('#changeInfo').addClass('active');
    });

    $('.close-changeInfo').click(function () {
        $('.modal-changeInfo').css('display', 'none');
        $('#changeInfo').removeClass('active');
    });
    
    $('#changePwd').click(function () {
        $('.modal-changePwd').css('display', 'block');
    });

    $('.close-changePwd').click(function () {
        $('.modal-changePwd').css('display', 'none');
    });


});


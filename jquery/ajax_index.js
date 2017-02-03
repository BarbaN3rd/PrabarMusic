$(document).ready(function () {
    $('.add').click(function () {
        IDBrano = $(this).attr('id'); //prendo l'id della canzone
        //alert(IDBrano);
        IDBranos = "." + IDBrano;
        //alert(IDBranos);
        $.ajax({
            type: "POST",
            data: {brano: IDBrano},
            url: "rent.php",
            success: function () {
                $(IDBranos).html("<div class='not-aviable'><span>Brano già nolleggiato</span></div>");
            },
            error: function () {
                alert('Error occured');
            }
        });
    });
});



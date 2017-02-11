/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    $('#nBrano').keyup(function () {

        nomeBrano = $(this).val();
        $.ajax({
            type: "POST",
            data: {brano: nomeBrano},
            url: "searchsong.php",
            dataType: "json",
            success: function (data) {
                //alert(data);
                var tabella = "";
                if (nomeBrano != "") {
                    if (data == "[object Object]") {
                        var dim = data.prova.length;
                        //alert(dim);
                        for (var i = 0; i < dim; i++) {
                            tabella = tabella + "<tr><td>" + data.prova[i].Autore + "</td><td>" + data.prova[i].Titolo + "</td></tr>";
                        }
                        $('#similarSongs').css('display', 'block');
                        tabella = "<tr class='bold'><td>Autore</td><td>Titolo</td></tr>" + tabella;
                        $('#similarSongs table').html(tabella);
                        //alert(tabella);
                    } else {
                        $('#similarSongs').css('display', 'block');
                        $('#similarSongs table').html("<span class='bold' style='font-size: 14px'>" + data + " simile trovato, puoi caricare liberamente il tuo!</span>");
                    }
                } else {
                    $('#similarSongs').css('display', 'none');
                }

            },
            error: function () {
                //alert('errore');
            }

        });

    });

});
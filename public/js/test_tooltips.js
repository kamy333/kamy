/**
 * Created by Kamran on 5/25/2015.
 */




$("document").ready(function() {

    //alert('shalom');

    //$("#reverse_adresse").css("border", "3px solid red");


    $("#reverse_adresse").click(function(){
     var var1=   $("#arrivee").val();
     var var2=   $("#depart").val();

        $("#arrivee").val(var2);
        $("#depart").val(var1);

    });

$('[data-toggle="tooltip"]').tooltip();

    $(".close").click(function(){$("#myAlert").alert();  });


$('#animate').animate(  { top: '0' }, 1000);



 scroll();

    function scroll() {
        $('#scrolltext').css('left', $('#scrollcontainer').width());
        $('#scrolltext').animate({
            left: '-='+($('#scrollcontainer').width()+$('#scrolltext').width())
        }, 20000, function() {
            scroll();
        });
    }




});



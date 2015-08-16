/**
 * Created by Kamran on 5/11/2015.
 */


$("document").ready(function() {

    $(".divheureretour").hide();
    $(".divname").hide();
    $(".divnompatient").hide();
    $(".divbon_no").hide();
    $("#hidelist").hide();


    // on change click
    $("#Heure").on("change", change_heuredepart);

    // $("#Heure").on("change", change_heuredepart);


    //$("#DateCourse").css("border", "1px solid black");
    $("#Chauffeur").css("border", "1px solid black");

    $("#Heure").css("border", "1px solid black");

    $("#AllerRetour").css("border", "1px solid black");
    $("#HeureRetour").css("border", "1px solid black");
    $("#Pseudo").css("border", "1px solid black");
    $("#name").css("border", "1px solid black");
    $("#Bon_No").css("border", "1px solid black");
    $("#Nom_Patient").css("border", "1px solid black");
    $("#Depart").css("border", "1px solid black");
    $("#Arrivee").css("border", "1px solid black");
    $("#Remarque").css("border", "1px solid black");





    //$(".kamy").css("background", "white");
    //$(".kamy").css("border", "1px solid black");
    //$("body").css("background", "black");


    $("#err_DateCourse").html("&nbsp;&nbsp;&nbsp;Veuillez changer la date si ce n'est la date d'aujourd'hui");
    $("#err_DateCourse").append("&nbsp;&nbsp<button type=\"button\" class=\"btn btn-default\" id=\"buttonDateCourse\">ok</button>");
    $("#buttonDateCourse").on("click", click_buttonDateCourse);

    $("#err_Heure").html("&nbsp;&nbsp;&nbsp;Veuillez indiquer l'heure départ");


    current_hour();

});

function click_buttonDateCourse(){
    $("#err_DateCourse").html("");
    $("#buttonDateCourse").hide();
    $("#DateCourse").parent('div').addClass('has-success has-feedback');
    $("#DateCourse").after( "<span class=\"glyphicon glyphicon-ok form-control-feedback\" aria-hidden=\"true\"></span>" );
    $("#DateCourse").css("border", "3px solid green");
}


function change_heuredepart(){
   // $("#Heure").val("02h30");
   // $( "div" ).addClass( "has-success" );
    $("#Heure").parent('div').addClass('has-success has-feedback');
    $("#Heure").css("border", "3px solid green");
    $("#Heure").after( "<span class=\"glyphicon glyphicon-ok form-control-feedback\" aria-hidden=\"true\"></span>" );
    $("#err_heuredepart").html("   Error : heure depart");
    $("#err_heuredepart").css("color", "3px solid red");
}



function current_hour(){
    var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes();

    minutes=dt.getMinutes();
    var h= dt.getHours();
    var m = (((minutes + 7.5)/15 | 0) * 15) % 60;
    var mn= getminute(m)  ;
    var hr=gethour(h) ;
    $("#Heure").val(hr + "h00");
}


function gethour(h){
    if (h.length==1) {
        h = "0" + h;
    }else if(h==0){
        h="00";
    }  else {
        h =  h;
    }
    return h;
}

function getminute(m){
    if (m.length==1) {
        m = "0" + m;
    }else if(m==0){
        m="00";
    }  else {
        m =  m;
    }
    return m;
}
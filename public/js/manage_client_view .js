/**
 * Created by Kamy on 11/1/2014.
 */

/*

todo multi button find a better solution, not working IE

*/

$( "#button_recherche_voir" ).click(function() {
    $("#form_recherche").show();
    $("#button_recherche_cache").show();
    $("#button_recherche_voir").hide();

});




$( "#button_recherche_cache" ).click(function() {
    $("#form_recherche").hide();
    $("#button_recherche_voir").show();
    $("#button_recherche_cache").hide();

});






$( "#button_panel_voir" ).click(function() {
    $("#mes_courses").show();
    $("#form_recherche").hide();
    $("#button_recherche_voir").show();
    $("#button_recherche_cache").hide();
    $("#button_panel_voir").hide();
    $("#button_panel_cache").show();
    $(".a-rech").show();




});

$( "#button_panel_cache" ).click(function() {
    $("#mes_courses").hide();
    $("#form_recherche").hide();
    $("#button_recherche_voir").hide();
    $("#button_recherche_cache").hide();
    $("#button_panel_cache").hide();
    $("#button_panel_voir").show();
    $(".a-rech").hide();

});

$( "#button_remarque_cache" ).click(function() {
    $(".hide-remarque").hide();
    $("#button_remarque_voir").show();
    $("#button_remarque_cache").hide();
});


$( "#button_remarque_voir" ).click(function() {
    $(".hide-remarque").show();
    $("#button_remarque_voir").hide();
    $("#button_remarque_cache").show();

});

$( "#show-row-all" ).click(function() {
    $(".hide-success").show();
    $(".hide-danger").show();
    $(".hide-others").show();

});

$( "#show-row-success" ).click(function() {
    $(".hide-success").show();
    $(".hide-danger").hide();
    $(".hide-others").hide();

});


$( "#show-row-danger" ).click(function() {
    $(".hide-success").hide();
    $(".hide-danger").show();
    $(".hide-others").hide();

});

$( "#hide-row-success" ).click(function() {
    $(".hide-success").hide();

});

$( "#hide-row-danger" ).click(function() {
    $(".hide-danger").hide();

});

$( "#hide-row-others" ).click(function() {
    $(".hide-others").hide();

});




$( "#show-row-others" ).click(function() {

    $(".hide-others").show();
    $(".hide-success").hide();
    $(".hide-danger").hide();

});

window.onload = function () {

    $("#form_recherche").hide();
    $("#mes_courses").show();
    $("#button_panel_cache").show();
    $("#button_panel_voir").hide();


    $("#button_recherche_voir").show();
    $("#button_recherche_cacher").hide();

    $(".hide-remarque").hide();


    $("#button_remarque_cache").hide();

    $(".hide-success").show();
    $(".hide-danger").show();
    $(".hide-others").show();





};
//footer js

$(document).ready(function(){
    $margin = ($(window).width()-$(".main").width())/2-10;
    $(".before-footer").css("margin-left",$margin);
    console.log($(window).width());
});
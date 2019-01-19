var typingTimer;
var doneTypingInterval = 100;
var $input = $('#search-input');
var button = document.getElementById("search-button");
$(document).ready(function(){
    $("#search-input").keydown(function(e){
        if(e.originalEvent.key.length == 1 || e.which == 8) 
        {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });
    $("#search-input").keyup(function(e){
        if(e.originalEvent.key.length == 1 || e.which == 8)
        {
            clearTimeout(typingTimer);
        }
    });
    function doneTyping () {
        console.log($("#search-input").val());
    }

    

});








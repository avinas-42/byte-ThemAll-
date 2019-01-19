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
    fetch("http://localhost/app/bunchly/index.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        credentials: 'same-origin',
    
        // this line is to allow to push on my rails app through the plug_in
        body: JSON.stringify({
          
          tags: "tags"
        })
      })
      .then(response => response.json())
      .then((data) => {
        
        if(data.status == "ok") {
         
        }else if(data.status == "already"){
          
        }
      });
    

});








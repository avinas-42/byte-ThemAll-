function creerInstance(){
  if(window.XMLHttpRequest){
    /* Firefox, Opera, Google Chrome */
    return new XMLHttpRequest();
  }else if(window.ActiveXObject){
    /* Internet Explorer */
    var names = [
      "Msxml2.XMLHTTP.6.0",
      "Msxml2.XMLHTTP.3.0",
      "Msxml2.XMLHTTP",
      "Microsoft.XMLHTTP"
    ];
    for(var i in names){
      /* On test les différentes versions */
      try{ return new ActiveXObject(names[i]); }
      catch(e){}
    }
    alert("Non supporte");
    return null; // non supporté
  }
};



function envoyerDonnees (num,state){
  var req =  creerInstance();
 /* On récupère les données du formulaire */
  var id=num;
  var group=state;
  req.onreadystatechange = function(){
  /* Si l'état = terminé */
  if(req.readyState == 4){
    /* Si le statut = OK */
    if(req.status == 200){
      /* On affiche la réponse */
      alert(req.responseText);
    }else{
  
    }
  }
};
    
  req.open("GET", "model/json_encode_for_d3.php?id="+id+"&group="+group, true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  /* On met à null car c’est une commande GET*/
   req.send(null);
}
<?php
require 'model/bdd.php';


if (isset($_POST['submit']))
{                  
    
  if(!empty($_POST['pseudo'])AND !empty($_POST['password'])  AND !empty($_POST['email']))
  {
    $pseudo = htmlspecialchars($_POST['pseudo']);
	$password = htmlspecialchars($_POST['password']);
	$email = htmlspecialchars($_POST['email']);
	$taillenom = strlen($pseudo);
     if($taillenom <= 40)
       {
		$requete="create(n:user{pseudo:'$pseudo',password:'$password',mail:'$email'})";   
              /*  $verification=GETrequete($verif);        
                    if($verification!=NULL){
                        echo '<script> window.alert("cet utilisateur existe déja!!")<script>';
                    }else{
                         POSTrequete($requete);
                    }
              */POSTrequete($requete);          
                        
               
                
        }
          else
            {
              $erreur = "<strong>Votre pseudo ne peut pas faire plus de 40 caracteres !</strong>";
            }

  }   else
    {
      $erreur = "<strong>Tous les champs doivent etre remplis !</strong>";
    }
}

?>
<!doctype html>
<html>
    <head>
        <link href="assets/css/css.css" rel="stylesheet" type="text/css"/>
    </head>    
    <body>
        <header>
            <h1>Bunchly_project</h1>         
        </header>   
       
<div id="inscription" >
            
            <article class="col-lg-9 col-md-9 col-sm-9 col-xs-10">
                      <section id="form">
                              <form method="POST" action='#'>
							<p>
                                                            <label>Votre pseudo</label>
								<input type="text" name="pseudo" id="i_pseudo"class="formulaire"pattern="[a-zA-Z]+">
							</p>

									
							<p>
                                                            <label>Votre mot de passe</label>
								<input type="text" name="password" id="i_password"class="formulaire">
							</p>

							<p>
							
                                                            <label>Votre mail</label>
								<input type="email" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="i_Email"class="formulaire">
							</p>
								
							
							
							<p>

								<input type="submit" id="i_button" name="submit" value="S'inscrire" onclick="validation_form()">
							</p>
                            </form>		
                    <section>
            </article>
            
             <aside id="pub" class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
               
                
            </aside>
            
            
            
            
        </div> 
    </body>
</html>
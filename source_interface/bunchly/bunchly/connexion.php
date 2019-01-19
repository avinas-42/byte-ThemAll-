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
		$requete="match (n:user) where n.pseudo='$pseudo' n.password='$password' return n";   
              $verification=GETrequete($verif);        
                    if($verification!=NULL){
                        session_start();
                        header('Location: http://localhost/bunchly/bunchly/index.php',$_SESSION['pseudo']);
                        exit();
                    }else{
                        
                        echo '<script> window.alert("identifiants incorrects!!")<script>';
                    }
               
                        
               
                
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